<?php
/**
 * @author Yuriy Basov <basowy@gmail.com>
 * @since 1.0.0
 */

namespace yii2x\user\models;

use Yii;
use yii\base\Model;


class EmailForm extends Model{
    
    
    public $email;
    
    
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
        ];
    }       
}