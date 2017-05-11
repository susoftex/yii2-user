<?php
/**
 * @author Yuriy Basov <basowy@gmail.com>
 * @since 1.0.0
 */

namespace yii2x\user\behaviors;

use Yii;
use yii\base\Behavior;
use yii\db\Expression;
use yii\helpers\Url;

class SignupBehavior extends Behavior
{
        
    
    public function signup(){
        
        $this->owner->token = Yii::$app->security->generateRandomString(64);
        $this->owner->expired_at = new Expression('DATE_ADD( UTC_TIMESTAMP(), INTERVAL 1 DAY)'); 
        if($this->owner->save()){
            return $this->emailSignup();
        }
        return false;

    }

    public function emailSignup(){
        $mailer = Yii::$app->mailer;
        $mailer->viewPath = __DIR__ . '/../mail'; //'@yii2-user/mail/';

        
        $data = ['url' => Url::to(['/auth/registration', 'token' => $this->owner->token], true)];
 
        return $mailer->compose(['html' => 'html/signup', 'text' => 'text/signup'], $data)
                            ->setTo($this->owner->email)
                            ->setFrom(\Yii::$app->params['adminEmail'])
                            ->setSubject('Sign up Request from ' . Yii::$app->name)
                            ->setReadReceiptTo('basowy@gmail.com')
                            ->send();
    }
       
}
