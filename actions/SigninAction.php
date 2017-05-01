<?php
/**
 * @author Yuriy Basov <basowy@gmail.com>
 * @since 1.0.0
 */

namespace yii2x\user\actions;

use Yii;
use yii\base\Action;
use yii2x\user\models\UsernameSigninForm;

class SigninAction extends Action
{
    public $view = '@vendor/yii2x/yii2-user/views/auth/signin';
    
    public function run()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->controller->goHome();
        }

        $model = new UsernameSigninForm();
        
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->controller->goBack();
        }
 
        $model->password = null;

        return $this->controller->render($this->view, [
            'model' => $model,
        ]); 
    }    
}

