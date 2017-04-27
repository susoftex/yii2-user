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
            
            'login' => [
                'class' => '\yii2x\user\actions\LoginAction',
                'view' => '@vendor/yii2x/yii2-user/views/auth/login'
            ],  
            
            'logout' => [
                'class' => '\yii2x\user\actions\LogoutAction',
            ],   
            
            'registration' => [
                'class' => '\yii2x\user\actions\RegistrationAction',
                'view' => '@vendor/yii2x/yii2-user/views/auth/registration'
            ],              
        ];
    }
}
