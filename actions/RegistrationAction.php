<?php
/**
 * @author Yuriy Basov <basowy@gmail.com>
 * @since 1.0.0
 */

namespace yii2x\user\actions;

use Yii;
use yii\base\Action;
use yii2x\user\models\Signup;
use yii2x\user\models\User;
use yii2x\user\models\RegistrationForm;

class RegistrationAction extends Action
{
    public $view = '@vendor/yii2x/yii2-user/views/auth/registration';
       
    
    public function run($token)
    {
        
        if(Yii::$app->user->isGuest == false){
            Yii::$app->user->logout();
            return $this->controller->refresh();
        }
        
        $signup = Signup::findByToken($token);
        if(empty($signup)){
            Yii::$app->session->setFlash('failure', "Sign up request invalid or expired. Please try again later.");
            return $this->controller->redirect(['auth/signup']);
        }
        
        
        $model = new RegistrationForm();
        $model->token = $token;
        $model->email = $signup->email;
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) { 

            $user = new User();
  
            if($user->load(['User'=>$model->getAttributes()]) && $user->save()){
                $signup->delete();
                $user->emailWelcome();
                Yii::$app->session->setFlash('success', 'Thank you, registration is now completed.');
                Yii::$app->user->login($user, 5);// 3600*24*30
                return $this->controller->goHome();                    
            }
            else{
                $model->addErrors($user->getErrors());
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

