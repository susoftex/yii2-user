<?php
namespace yii2x\user\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm get user's login and password, validates them and logs the user in. 
 *
 * @author John Martin <john.itvn@gmail.com>
 * @since 1.0.0
 */
class LoginForm extends Model{
    
    /** @var string The login field*/
    public $username;
    
    public $email;

    /** @var string User's plain password */
    public $password;

    /** @var string Whether to remember the user */
    public $rememberMe = false;

    private $_user = false;
    
    /** @inheritdoc */
    public function attributeLabels()
    {
        return [
            'username'            => Yii::t('user', 'Username'),
            'email'            => Yii::t('user', 'Email'),
            'password'         => Yii::t('user', 'Password'),
            'rememberMe'       => Yii::t('user', 'Remember me next time'),
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

            [['username', 'email'], 'trim'],
            ['email', 'email'],
            
            ['username', 'required', 'on' => 'default'],
            ['password', 'required', 'on' => 'default'],
            
            ['email', 'required', 'on' => 'EmailLoginScenario'],
            ['password', 'required', 'on' => 'EmailLoginScenario'],
                     
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
     * Finds user by loginFieldName
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {

            $loginFieldName = Yii::$app->controller->module->getLoginFieldName();
            $this->_user = \yii2x\user\models\User::find()->where([
                $loginFieldName => $this->username
            ])->one();
        }

        
        if($this->_user){
            $this->_user->setScenario('EmailLoginScenario');
        }
        
        return $this->_user;
    }    
}
