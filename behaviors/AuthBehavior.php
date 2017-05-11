<?php
/**
 * @author Yuriy Basov <basowy@gmail.com>
 * @since 1.0.0
 */

namespace yii2x\user\behaviors;

use Yii;
use yii\base\Behavior;
use yii\db\BaseActiveRecord;
use yii\db\Expression;
use yii\helpers\Url;

class AuthBehavior extends Behavior
{
    
    public $passwordAttribute = 'password';
    public $passwordHashAttribute = 'password_hash';

    public function events()
    {
        return [
            BaseActiveRecord::EVENT_BEFORE_INSERT => 'onBeforeSave',
            BaseActiveRecord::EVENT_BEFORE_UPDATE => 'onBeforeSave',
        ];
    } 

    public function onBeforeSave($event){
        $password = $this->owner[$this->passwordAttribute];
        if(!empty($password)){  
            $this->owner[$this->passwordHashAttribute] = Yii::$app->security->generatePasswordHash($password);
        }
    }     
    
    public function signup(){
        
        $this->token = Yii::$app->security->generateRandomString(64);
        $this->token_type = 'SIGNUP';
        $this->token_code = null;
        $this->token_expired_at = new Expression('DATE_ADD( UTC_TIMESTAMP(), INTERVAL 1 DAY)'); 
        $this->save();
        
        if($this->emailSignup() == false){
            $this->delete();
            $this->addError('email','Sign up email request failed. Please try again later.');
            return false;
        }
        
        return true;
    }

    public function emailSignup(){
        $mailer = Yii::$app->mailer;
        $mailer->viewPath = __DIR__ . '/../mail';

        
        $data = ['url' => Url::to(['/auth/registration', 'token' => $this->token], true)];
 
        return $mailer->compose(['html' => 'html/signup', 'text' => 'text/signup'], $data)
                            ->setTo($this->email)
                            ->setFrom(\Yii::$app->params['adminEmail'])
                            ->setSubject('Signup Request from ' . Yii::$app->name)
                            ->setReadReceiptTo('basowy@gmail.com')
                            ->send();
    }
    
//    public function confirm(){
//        
//        $this->owner->token_expired_at = null;
//        $this->owner->token = null;
//        $this->owner->token_type = null;
//        $this->owner->token_code = null;
//        $this->owner->confirmed_at = new Expression('UTC_TIMESTAMP()');
//
//        return $this->owner->save();        
//    }
//    
//    public function isConfirmed(){
//        return (!empty($this->owner->id) && $this->owner->confirmed_at != null);
//    }
//    
//    public function initConfirmation(){
//
//
//        $this->owner->token = Yii::$app->security->generateRandomString(64);
//        $this->owner->token_type = 'CONFIRMATION';
//        $this->owner->token_code = null;
//        $this->owner->token_expired_at = new Expression('DATE_ADD( UTC_TIMESTAMP(), INTERVAL 1 DAY)');
//
//        return true;
//    }
//        
//    
//    
//    public function emailConfirmation($user = null){
//        if($user === null){
//            $user = $this->owner;
//        }
//
//
//        $mailer = Yii::$app->mailer;
//        $mailer->viewPath = '@yii2-user/mail/';
//
////$logger = new \Swift_Plugins_Loggers_ArrayLogger();
////$mailer->transport->registerPlugin(new \Swift_Plugins_LoggerPlugin($logger));        
//        
//        
//        $data = ['url' => Url::to(['/auth/confirmation', 'token' => $user->token], true)];
//        
//            
//            
//            
//            
//        return $mailer->compose(['html' => 'html/confirmation', 'text' => 'text/confirmation'], $data)
//                            ->setTo($user->email)
//                            ->setFrom(\Yii::$app->params['adminEmail'])
//                            ->setSubject('Registration Confirmation at ' . Yii::$app->name)
//                            ->setReadReceiptTo('basowy@gmail.com')
//                            ->send();
//
//    }   
    
    public function emailWelcome($user = null){
        if($user === null){
            $user = $this->owner;
        }


        $mailer = Yii::$app->mailer;
        $mailer->viewPath = __DIR__ . '/../mail';

        $data = ['model' => $user];

        return $mailer->compose(['html' => 'html/welcome', 'text' => 'text/welcome'], $data)
                        ->setTo($user->email)
                        ->setFrom(\Yii::$app->params['adminEmail'])
                        ->setSubject('Welcome to ' . Yii::$app->name)
                        ->send();

    }  

    public function emailUsernameRequest($user = null){
        
        if($user === null){
            $user = $this->owner;
        }

        $this->owner->token = Yii::$app->security->generateRandomString(64);
        $this->owner->token_code = Yii::$app->security->generateRandomString(8);
        $this->owner->token_type = 'USERNAME';
        $this->owner->token_expired_at = new Expression('DATE_ADD( UTC_TIMESTAMP(), INTERVAL 1 HOUR)');  
  
        $data = [
            'url' => Url::to(['/auth/usernameview', 'token' => $user->token], true)
        ];            

        $mailer = Yii::$app->mailer;
        $mailer->viewPath = __DIR__ . '/../mail';


        if($mailer->compose(['html' => 'html/username-request', 'text' => 'text/username-request'], $data)
            ->setTo($user->email)
            ->setFrom(Yii::$app->params['adminEmail'])
            ->setSubject('Username Request from ' . Yii::$app->name)
            ->send()){
           
            return $user->emailVerificationCode();                 
            
        }    

        return false;
        
    }  

    public function emailPasswordRequest($user = null){
        
        if($user === null){
            $user = $this->owner;
        }
        
        $this->owner->token = Yii::$app->security->generateRandomString(64);
        $this->owner->token_code = Yii::$app->security->generateRandomString(8);
        $this->owner->token_type = 'PASSWORD';
        $this->owner->token_expired_at = new Expression('DATE_ADD( UTC_TIMESTAMP(), INTERVAL 1 HOUR)'); 

        $data = [
            'url' => Url::to(['/auth/passwordreset', 'token' => $user->token], true)
        ];            

        $mailer = Yii::$app->mailer;
        $mailer->viewPath = __DIR__ . '/../mail';
        
        if($mailer->compose(['html' => 'html/password-request', 'text' => 'text/password-request'], $data)
                            ->setTo($user->email)
                            ->setFrom(Yii::$app->params['adminEmail'])
                            ->setSubject('Password Request from ' . Yii::$app->name)
                            ->send()){
        
            return $user->emailVerificationCode();            
        }
          
        return false;
    }     

    public function emailPasswordReset($user = null){
        
        if($user === null){
            $user = $this->owner;
        }        
        

        $mailer = Yii::$app->mailer;
        $mailer->viewPath = __DIR__ . '/../mail';
        
        $data = [
            'url' => Url::to(['/auth/login'], true),
        ];   
        
        try{
            return $mailer->compose(['html' => 'html/password-reset', 'text' => 'text/password-reset'], $data)
                            ->setTo($user->email)
                            ->setFrom(\Yii::$app->params["adminEmail"])
                            ->setSubject('Password Reset at ' . Yii::$app->name)
                            ->send();
        } catch (\Swift_SwiftException $ex) {
            return $ex->getMessage();
        }
    }    
    
    public function emailVerificationCode($user = null){
        
        if($user === null){
            $user = $this->owner;
        }        
        

        $mailer = Yii::$app->mailer;
        $mailer->viewPath = __DIR__ . '/../mail';
        
        $data = [
            'verification_code' => $user->token_code,
        ];   
        
        try{
            return $mailer->compose(['html' => 'html/verification-code', 'text' => 'text/verification-code'], $data)
                            ->setTo($user->email)
                            ->setFrom(\Yii::$app->params["adminEmail"])
                            ->setSubject('Verification Code from ' . Yii::$app->name)
                            ->send();
        } catch (\Swift_SwiftException $ex) {
            return $ex->getMessage();
        }
    }         
    
}
