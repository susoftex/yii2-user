<?php
/**
 * @author Yuriy Basov <basowy@gmail.com>
 * @since 1.0.0
 */

namespace yii2x\user\actions;

use Yii;
use yii\base\Action;
use yii2x\user\models\Signup;


class SignupAction extends Action
{
    public $layout = null;
    public $view = '@vendor/yii2x/yii2-user/views/auth/signup';
       
    
    public function run()
    {
        $model = new Signup();
        
        if ($model->load(Yii::$app->request->post())&& $model->validate()){ 
            
            if($model->signup()){                
                Yii::$app->session->setFlash('success', "Please check your email. You will receive an email from us with sign up instructions. If you don't receive this email, please check your junk mail folder or sign up again.");                 
            }
            else{
                $model->delete();
                $model = new Signup();
                Yii::$app->session->setFlash('failure', "Sign up email request failed. Please try again later.");
            } 
            
            return $this->controller->refresh();
        }

        return $this->controller->render($this->view, [
            'model' => $model,
        ]);
    }    
}