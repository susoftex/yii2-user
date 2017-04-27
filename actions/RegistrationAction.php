<?php
/**
 * @author Yuriy Basov <basowy@gmail.com>
 * @since 1.0.0
 */

namespace yii2x\user\actions;

use Yii;
use \yii\base\Action;

class RegistrationAction extends Action
{
    public $view = '@vendor/yii2x/yii2-user/views/auth/registration';
    
    public function run()
    {
        
        if(\Yii::$app->user->isGuest == false){
            \Yii::$app->user->logout();
            return $this->controller->refresh();
        }
        
        $model = Yii::createObject([
            'class' => '\yii2x\user\models\RegistrationForm'
        ]);
        
        if ($model->load(Yii::$app->request->post())) { 

            if($model->validate()){                
                return $this->controller->redirect(\Yii::$app->user->loginUrl);                
            }
            else{
                \Yii::$app->session->setFlash('failure', Yii::t('app', 'User is not created.'));
            }
        } 
      
        $model->password = 123123;
        $model->confirm_password = 123123;      
     
        $model->username = 'USER';
        $model->title = 'Developer';
        $model->email = 'user@test.com';
        $model->first = 'FIRST';
        $model->last = 'LAST';
        $model->phone = '11111111111';
        
        return $this->controller->render($this->view, [
            'model' => $model,
        ]);
    }    
}

