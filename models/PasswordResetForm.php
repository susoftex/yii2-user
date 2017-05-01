<?php
/**
 * @author Yuriy Basov <basowy@gmail.com>
 * @since 1.0.0
 */

namespace yii2x\user\models;

use Yii;
use yii\base\Model;


class PasswordResetForm extends Model {
    

    public $username;

    public $password;

    public $confirm_password;
    
    public $verification_code;
    
        
    /**
     * @inheritdoc
     */
    public function rules()
    {       
        return [          
            [['username'], 'filter', 'filter' => 'trim'],
            [['username', 'password', 'confirm_password', 'verification_code'], 'required'], 
            ['password', 'string', 'min' => 6],
            ['confirm_password', 'compare', 'compareAttribute'=>'password', 'message'=>Yii::t("app","Confirm Password doesn't match")],
          
        ];
    }
    
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username'         => Yii::t('app', 'Username'),
            'password'         => Yii::t('app', 'New Password'),
            'confirm_password' => Yii::t('app', 'Confirm Password'),
            'verification_code'            => Yii::t('app', 'Verification Code'),
            
        ];
    }    
}
