<?php
/**
 * @author Yuriy Basov <basowy@gmail.com>
 * @since 1.0.0
 */

namespace yii2x\user\controllers;

use Yii;
use yii\web\Controller;
/**
 * Default controller for the `user` module
 */
class AuthController extends Controller
{
    
    public function init()
    {
        Yii::setAlias("@yii2-user", __DIR__ . '/../');
    }
    
    
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            
            'signin' => [
                'class' => '\yii2x\user\actions\SigninAction',
                'view' => '@vendor/yii2x/yii2-user/views/auth/login'
            ],  
            
            'signout' => [
                'class' => '\yii2x\user\actions\SignoutAction',
            ],   
        
            'signup' => [
                'class' => '\yii2x\user\actions\SignupAction',
                'view' => '@vendor/yii2x/yii2-user/views/auth/signup'
            ],              
            
            'registration' => [
                'class' => '\yii2x\user\actions\RegistrationAction',
                'view' => '@vendor/yii2x/yii2-user/views/auth/registration'
            ],   

            'passwordrequest' => [
                'class' => '\yii2x\user\actions\PasswordRequestAction',
                'view' => '@vendor/yii2x/yii2-user/views/auth/password_request'
            ],   
            
            'passwordreset' => [
                'class' => '\yii2x\user\actions\PasswordResetAction',
                'view' => '@vendor/yii2x/yii2-user/views/auth/password_reset'
            ],   

            'usernamerequest' => [
                'class' => '\yii2x\user\actions\UsernameRequestAction',
                'view' => '@vendor/yii2x/yii2-user/views/auth/username_request'
            ], 
          
            'usernameview' => [
                'class' => '\yii2x\user\actions\UsernameViewAction',
                'view' => '@vendor/yii2x/yii2-user/views/auth/username_view'
            ],             
            
            'message' => [
                'class' => '\yii2x\user\actions\MessageAction',
                'view' => '@vendor/yii2x/yii2-user/views/auth/message'
            ],             
        ];
    }
}
