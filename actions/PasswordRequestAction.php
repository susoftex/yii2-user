<?php
/**
 * @author Yuriy Basov <basowy@gmail.com>
 * @since 1.0.0
 */

namespace yii2x\user\actions;

use Yii;
use yii\base\Action;
use yii2x\user\models\UsernameEmailForm;
use yii2x\user\models\User;

class PasswordRequestAction extends Action
{
    public $layout = null;
    public $view = '@vendor/yii2x/yii2-user/views/auth/password_request';
    
    public function run()
    {
        $model = new UsernameEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) { 
            
            $user = User::findByUsernameEmail($model->username, $model->email);
            if(!empty($user->id)){
             
                if($user->emailPasswordRequest() && $user->save()){
                    Yii::$app->session->setFlash('success', \Yii::t('app', 'Password Request sent to ') . $user->email);
                }                   
                else{
                    Yii::$app->session->setFlash('failure', \Yii::t('app', 'Password Request failed.'));
                }             
            }
            else{
                $model->addError('username', '');
                $model->addError('email', 'Username or Email is invalid.');
            }
        }   
        
        return $this->controller->render($this->view, [
            'model' => $model,
        ]);          
    }    
}

