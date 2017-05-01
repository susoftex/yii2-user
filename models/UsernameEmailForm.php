<?php
/**
 * @author Yuriy Basov <basowy@gmail.com>
 * @since 1.0.0
 */

namespace yii2x\user\models;

use Yii;
use yii\base\Model;


class UsernameEmailForm extends Model{
    
    public $username;
    
    public $email;
    
    
    /** @inheritdoc */
    public function attributeLabels()
    {
        return [
            'username'            => Yii::t('app', 'Username'),
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
            [['username', 'email'], 'required'],
            ['email', 'trim'],
            ['email', 'email'],    
        ];
    }       
}