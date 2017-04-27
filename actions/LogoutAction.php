<?php
/**
 * @author Yuriy Basov <basowy@gmail.com>
 * @since 1.0.0
 */

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

