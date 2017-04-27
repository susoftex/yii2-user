YII2 User Extension - Under Development
===================
YII2 User Extension

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist yii2x/yii2-user "dev-master"
```

or add

```
"yii2x/yii2-user": "dev-master"
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