<?php
/**
 * @author Yuriy Basov <basowy@gmail.com>
 * @since 1.0.0
 */

namespace yii2x\user\models;

use Yii;
use yii\base\Model;


class RegistrationForm extends Model {
    
    public $token;
    
    public $code; 
    
    public $username;

    public $password;

    public $confirm_password;
    
    public $title;
    
    public $first;
    
    public $last;
    
    public $phone;
    
    public $email;
        
    /**
     * @inheritdoc
     */
    public function rules()
    {       
        return [          

            [['token', 'username', 'title', 'first', 'last', 'phone', 'email'], 'filter', 'filter' => 'trim'],
            [['token', 'username', 'password', 'confirm_password', 'title', 'email', 'first', 'last'], 'required'],
            [
                'username',
                'unique',
                'targetClass' => 'yii2x\user\models\User',
                'message' => Yii::t('app', 'Username already taken')
            ],
            [
                'email',
                'unique',
                'targetClass' => 'yii2x\user\models\User',
                'message' => Yii::t('app', 'Email already taken')
            ],
         
            ['email', 'email'],            
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
            'password'         => Yii::t('app', 'Password'),
            'confirm_password' => Yii::t('app', 'Confirm Password'),
            'title'         => Yii::t('app', 'Title'),
            'first'         => Yii::t('app', 'First Name'),
            'last'         => Yii::t('app', 'Last Name'),
            'phone'         => Yii::t('app', 'Phone'),
            'email'         => Yii::t('app', 'Email'),
            
        ];
    }    
}
