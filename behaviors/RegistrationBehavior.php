<?php
/**
 * @author Yuriy Basov <basowy@gmail.com>
 * @since 1.0.0
 */

namespace yii2x\user\behaviors;

use Yii;
use yii\base\Behavior;
use yii\db\BaseActiveRecord;
use yii2x\user\models\User;

class RegistrationBehavior extends Behavior
{
    public function events()
    {
        return [
            BaseActiveRecord::EVENT_AFTER_VALIDATE => 'onAfterValidate',
        ];
    } 

    public function onAfterValidate($event){

        if($this->owner->hasErrors() == false){

            $user = new User();

            if($user->load(['User'=>$this->owner->getAttributes()]) && $user->save()){
                $this->owner->_user = $user;
                return true;
            }   
            $this->owner->addErrors($user->getErrors());
        }   
        return false;
    }   
}
