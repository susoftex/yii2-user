<?php
/**
 * @author Yuriy Basov <basowy@gmail.com>
 * @since 1.0.0
 */

namespace yii2x\user\behaviors;

use Yii;
use yii\db\BaseActiveRecord;
use yii\base\Behavior;

class PasswordHashBehavior extends Behavior
{

    public $passwordAttribute = 'password';
    public $passwordHashAttribute = 'password_hash';

    public function events()
    {
        return [
            BaseActiveRecord::EVENT_BEFORE_INSERT => 'onBeforeSave',
            BaseActiveRecord::EVENT_BEFORE_UPDATE => 'onBeforeSave',
        ];
    } 

    public function onBeforeSave($event){
        $password = $this->owner[$this->passwordAttribute];
        if(!empty($password)){  
            $this->owner[$this->passwordHashAttribute] = Yii::$app->security->generatePasswordHash($password);
        }
    }     
}
