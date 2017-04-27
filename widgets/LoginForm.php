<?php
/**
 * @author Yuriy Basov <basowy@gmail.com>
 * @since 1.0.0
 */

namespace yii2x\user\widgets;

use yii\base\Widget;

class LoginForm extends Widget{
    
    public $model;
    public $loginScenario = 'USERNAME';
    
    public function run(){
        return $this->render('LoginForm', [
            'model'         => $this->model
        ]);          
    }   
}
