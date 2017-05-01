<?php
/**
 * @author Yuriy Basov <basowy@gmail.com>
 * @since 1.0.0
 */

namespace yii2x\user\actions;

use yii\base\Action;

class MessageAction extends Action
{
    public $view = '@vendor/yii2x/yii2-user/views/auth/message';
       
    
    public function run()
    {
        return $this->controller->render($this->view);
    }    
}

