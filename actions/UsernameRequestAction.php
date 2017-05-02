<?php
/**
 * @author Yuriy Basov <basowy@gmail.com>
 * @since 1.0.0
 */

namespace yii2x\user\actions;

use Yii;
use yii\base\Action;
use yii2x\user\models\EmailForm;
use yii2x\user\models\User;

class UsernameRequestAction extends Action
{
    public $layout = null;
    public $view = '@vendor/yii2x/yii2-user/views/auth/username_request';
    
    public function run()
    {
      
        $model = new EmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) { 
            
            $user = User::findByEmail($model->email);
            if(!empty($user->id)){

                $result = $user->emailUsernameRequest();
                if($result !== true){
                    Yii::$app->session->setFlash('failure', \Yii::t('app', $result));
                }                
                if($user->save()){
                    Yii::$app->session->setFlash('success', \Yii::t('app', 'Username Request sent to ') . $user->email);
                }                   
                else{
                    
                    Yii::$app->session->setFlash('failure', \Yii::t('app', 'Username Request failed.'));
                }             
            }
            else{
                $model->addError('email', 'Email is invalid.');
            }
        }   
        
        return $this->controller->render($this->view, [
            'model' => $model,
        ]);          
    }    
}

