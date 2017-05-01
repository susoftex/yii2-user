YII2 User Extension - Under Development
===================
YII2 User Extension

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist yii2x/yii2-user "@dev"
```

or add

```
"yii2x/yii2-user": "@dev"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by configuring application controller map and url manager :

```php

    'components' => [
        ...
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'showScriptName' => false,
            'rules' => [
                '/login' => '/auth/login',
                '/logout' => '/auth/logout',
                ...
            ]
        ],
        ...
    ],

    'controllerMap' => [
        'auth' => '\yii2x\user\controllers\AuthController'
    ],

```
Url Rules:
-------------------------------------------

'/signin'                   => '/auth/signin',
'/signout'                  => '/auth/signout',
'/signup'                   => '/auth/signup',
'/registration/<token>'     => '/auth/registration',
'/password-request'         => '/auth/passwordrequest',
'/password-reset/<token>'   => '/auth/passwordreset',
'/username-request'         => '/auth/usernamerequest',
'/username-view/<token>'    => '/auth/usernameview',



Controller:
-------------------------------------------


```php

class AuthController extends Controller
{
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
```

Widget:

```php

<?php
use yii2x\user\widgets\SigninForm;
?>

<?= SigninForm::widget([
    'model' => $model,
]) ?>


```

Migrations
----------

```php

yii migrate --migrationPath="vendor/yii2x/yii2-user/migrations"

```