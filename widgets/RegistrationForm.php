<?php
/**
 * @author Yuriy Basov <basowy@gmail.com>
 * @since 1.0.0
 */

namespace yii2x\user\widgets;

use yii\base\Widget;

class RegistrationForm extends Widget{
    
    public $model;
    
    public function run(){
        return $this->render('RegistrationForm', [
            'model'         => $this->model
        ]);          
    }   
}
