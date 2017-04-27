<?php
/**
 * @author Yuriy Basov <basowy@gmail.com>
 * @since 1.0.0
 */

namespace yii2x\user\behaviors;

use Yii;
use yii\base\Behavior;
use yii\db\Expression;
use yii\helpers\Url;

class RegistrationConfirmationBehavior extends Behavior
{

    public function initConfirmation(){

        if(!empty($this->owner->_user->id)){

            $this->owner->_user->confirm_token = Yii::$app->security->generateRandomString(64);
            $this->owner->_user->confirm_expired_at = new Expression('DATE_ADD( UTC_TIMESTAMP(), INTERVAL 1 DAY)');
            $this->owner->_user->save();

            
            $mailer = Yii::$app->mailer;
            $mailer->viewPath = '@yii2-user/mail/';
            
            $data = ['url' => Url::to(['/auth/confirmation', 'token' => $this->owner->_user->confirm_token], true)];
            
            return $mailer->compose(['html' => 'html/confirmation', 'text' => 'text/confirmation'], $data)
                            ->setTo($this->owner->email)
                            ->setFrom(\Yii::$app->params['adminEmail'])
                            ->setSubject('Registration Confirmation at ' . Yii::$app->name)
                            ->send();
        }
        
        return false;
    }     
}
