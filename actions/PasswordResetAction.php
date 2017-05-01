<?php
/**
 * @author Yuriy Basov <basowy@gmail.com>
 * @since 1.0.0
 */

namespace yii2x\user\actions;

use Yii;
use yii\base\Action;
use yii2x\user\models\User;
use yii2x\user\models\PasswordResetForm;


class PasswordResetAction extends Action
{   
    public $view = '@vendor/yii2x/yii2-user/views/auth/password_reset';
    
    
    public function run($token)
    {


        $user = User::findByToken($token);
        if(!empty($user->id)){
            
            $model = new PasswordResetForm();
            if ($model->load(Yii::$app->request->post()) && $model->validate()) { 

                if($model->username == $user->username && $model->verification_code == $user->token_code){
                    $user->password = $model->password;
                    $user->token = null;
                    $user->token_type = null;
                    $user->token_expired_at = null;
                    $user->token_code = null;
                    

                    if($user->save()){   
                        $user->emailPasswordReset();
                        Yii::$app->session->setFlash('success', Yii::t('app', 'Thank you, new password is set.'));
                    }                   
                    else{
                        Yii::$app->session->setFlash('failure', Yii::t('app', 'New password reset is failed.'));
                    }    
                    
                    return $this->controller->redirect(['auth/login']);  
                }
                else{      
                    $model->addError('verification_code', 'Incorrect Username or Rerification code.');
                    $model->addError('username', 'Incorrect Username or Rerification code.');
                }                
            }

            $model->password = null;
            $model->confirm_password = null;
            
            return $this->controller->render($this->view, [
                'model' => $model
            ]);              
        }
        else{
            Yii::$app->session->setFlash('failure', Yii::t('app', 'The password rerification link is invalid or expired. Please request a new one.'));
            return $this->controller->redirect(['auth/message']);  
        }        
    }    
}

