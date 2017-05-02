<?php
/**
 * @author Yuriy Basov <basowy@gmail.com>
 * @since 1.0.0
 */

namespace yii2x\user\actions;

use Yii;
use yii\base\Action;
use yii2x\user\models\VerificationCodeForm;
use yii2x\user\models\User;

class UsernameViewAction extends Action
{
    public $layout = null;
    public $view = '@vendor/yii2x/yii2-user/views/auth/username_view';
    
    public function run($token)
    {
        
        $model = new VerificationCodeForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) { 
            
            $user = User::findByToken($token);
            if(!empty($user->id)){   

                $user->token = null;
                $user->token_type = null;
                $user->token_expired_at = null;
                $user->token_code = null;

                $user->save();  

                Yii::$app->session->setFlash('success', \Yii::t('app', 'Your Username is: ') . $user->username);
                
                $model->verification_code = null;
        
            }
            else{
                $model->addError('verification_code', 'Verification Code is invalid.');
            }
        }   
        
        return $this->controller->render($this->view, [
            'model' => $model,
        ]);          
    }    
}

