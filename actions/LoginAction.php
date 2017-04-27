<?php
namespace yii2x\user\actions;

use Yii;

class LoginAction extends \yii\base\Action
{
    public $viewFile = '@vendor/yii2x/yii2-user/views/login';
    public function run()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->controller->goHome();
        }

        $module = $this->controller->module;
        $model = Yii::createObject([
            'class' => '\yii2x\user\models\LoginForm'
        ]);
        
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->controller->goBack();
        }
 
        $model->password = null;

        return $this->controller->render($this->viewFile, [
            'model' => $model,
        ]); 
    }    
}

