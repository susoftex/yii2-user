<?php
/**
 * @author Yuriy Basov <basowy@gmail.com>
 * @since 1.0.0
 */

namespace yii2x\user\behaviors;

use Yii;
use yii\base\Behavior;
use yii\db\BaseActiveRecord;
use yii\db\Expression;
use yii\helpers\Url;

class RegistrationConfirmationBehavior extends Behavior
{

    public function events()
    {
        return [
            BaseActiveRecord::EVENT_AFTER_VALIDATE => 'onAfterValidate',
        ];
    } 

    public function onAfterValidate($event){

        if(!empty($this->owner->_user->id)){

            $this->owner->_user->confirm_token = Yii::$app->security->generateRandomString(64);
            $this->owner->_user->confirm_expired_at = new Expression('DATE_ADD( UTC_TIMESTAMP(), INTERVAL 1 DAY)');
            $this->owner->_user->save();

            
            $mailer = Yii::$app->mailer;
            $mailer->viewPath = '@yii2-user/mail/';
            
            $data = ['url' => Url::to(['/auth/confirmation', 'token' => $this->owner->_user->confirm_token], true)];
            
            if($mailer->compose(['html' => 'html/confirmation', 'text' => 'text/confirmation'], $data)
                            ->setTo($this->owner->email)
                            ->setFrom(\Yii::$app->params['adminEmail'])
                            ->setSubject('Registration Confirmation at ' . \Yii::$app->name)
                            ->send()){
                
                Yii::$app->session->setFlash('success', \Yii::t('app', 'Confirmation email sent to') . ' ' . $this->owner->email);
            }                   
            else{
                Yii::$app->session->setFlash('failure', \Yii::t('app', 'Confirmation email is not sent to') . ' ' . $this->owner->email);
            }
        }
    }     
}
