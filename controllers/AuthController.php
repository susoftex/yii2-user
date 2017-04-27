<?php

namespace yii2x\user\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
/**
 * Default controller for the `user` module
 */
class AuthController extends Controller
{
    /**
     * @inheritdoc
     */
//    public function behaviors()
//    {
//        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'only' => ['logout'],
//                'rules' => [
//                    [
//                        'actions' => ['logout'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
//                ],
//            ],
//        ];
//    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            
            'login' => [
                'class' => '\yii2x\user\actions\LoginAction',
            ],  
            
            'logout' => [
                'class' => '\yii2x\user\actions\LogoutAction',
            ],              
        ];
    }


}
