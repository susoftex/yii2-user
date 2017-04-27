YII2 User Extension - Under Development
===================
YII2 User Extension

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist yii2x/yii2-user "*"
```

or add

```
"yii2x/yii2-user": "*"
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

Controller and widgets.
-------------------------------------------

Controller:

```php

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
                'view' => '@vendor/yii2x/yii2-user/views/auth/login'
            ],  
            
            'logout' => [
                'class' => '\yii2x\user\actions\LogoutAction',
            ],              
        ];
    }
}
```

Widget:

```php

<?php
use yii2x\user\widgets\LoginForm;
?>

<?= LoginForm::widget([
    'model' => $model,
]) ?>


```

Migrations
----------

```php

yii migrate --migrationPath="vendor/yii2x/yii2-user/migrations"

```