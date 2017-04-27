<?php
/**
 * @author Yuriy Basov <basowy@gmail.com>
 * @since 1.0.0
 */

namespace yii2x\user\models;

use Yii;
use yii\base\Model;
use yii2x\user\models\User;
use yii2x\user\behaviors\RegistrationConfirmationBehavior;

class ConfirmationResendEmailForm extends Model{
    
    
    public $email;
    
    public $_user;
    
    public function behaviors()
    {
        return [                         
            [
                'class' => RegistrationConfirmationBehavior::className(),
            ],              
        ];
    }      
    
    /** @inheritdoc */
    public function attributeLabels()
    {
        return [
            'email'            => Yii::t('app', 'Email'),
        ];
    }

     /** @inheritdoc */
    public function formName()
    {
        return 'email-form';
    }


    /** @inheritdoc */
    public function rules()
    {
        return [
            [['email'], 'required'],
            ['email', 'trim'],
            ['email', 'email'],    
            ['email', 'validateConfirmation'],
        ];
    }       
    
    public function validateConfirmation($attribute, $params)
    {
        $this->_user = User::find()->where(['email' => $this->email])->one();
        if(!empty($this->_user->id) && $this->_user->confirm_token == null && $this->_user->confirmed_at != null){
            $this->addError('email', 'User Account already confirmed.');
        }
        else if(empty($this->_user->id)){
            $this->addError('email', 'Email is invalid.');
        }
    }
}