<?php
/**
 * @author Yuriy Basov <basowy@gmail.com>
 * @since 1.0.0
 */

namespace yii2x\user\controllers;

use yii\web\Controller;
/**
 * Default controller for the `user` module
 */
class AuthController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            
            'login' => [
                'class' => '\yii2x\user\actions\LoginAction',
                'viewFile' => '@vendor/yii2x/yii2-user/views/auth/login'
            ],  
            
            'logout' => [
                'class' => '\yii2x\user\actions\LogoutAction',
            ],              
        ];
    }


}
