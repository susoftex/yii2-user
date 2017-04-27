<?php
namespace yii2x\user\actions;

use Yii;

class LogoutAction extends \yii\base\Action
{
    public function run()
    {

        Yii::$app->user->logout();
        return $this->controller->goHome();
        
    }    
}

