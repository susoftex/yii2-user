<?php
/**
 * @author Yuriy Basov <basowy@gmail.com>
 * @since 1.0.0
 */

namespace yii2x\user\models;

use Yii;
use yii\base\Model;

class UsernameLoginForm extends Model{
    
    /** @var string The username field*/
    public $username;

    /** @var string password */
    public $password;

    /** @var string whether to remember the user */
    public $rememberMe = false;

    private $_user = false;
    
    /** @inheritdoc */
    public function attributeLabels()
    {
        return [
            'username'            => Yii::t('app', 'Username'),
            'password'         => Yii::t('app', 'Password'),
            'rememberMe'       => Yii::t('app', 'Remember me next time'),
        ];
    }

     /** @inheritdoc */
    public function formName()
    {
        return 'login-form';
    }


    /** @inheritdoc */
    public function rules()
    {
        return [

            [['username'], 'trim'],
            
            ['username', 'required'],
            ['password', 'required'],
            
                     
            ['password', 'validatePassword'],                             
            ['rememberMe', 'boolean'],          
        ];
    }
 
    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if(!empty($user) && $user->confirm_token !== null){
                $this->addError($attribute, 'User Account is not confirmed.');
            }             
            elseif (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }


    
    /**
     * Logs in a user using the provided user model.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }
    
    /**
     * Finds user by username
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {

            $this->_user = \yii2x\user\models\User::find()->where([
                'username' => $this->username
            ])->one();
        }
        
        return $this->_user;
    }    
}
