<?php

namespace yii2x\user;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * user module definition class
 */
class Module extends \yii\base\Module
{
    
    public $loginScenario = 'USERNAME';
    public $views = [];
    
 
    protected $_views = [
        'login' => '@user/views/login'
    ];       
    
    
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'yii2x\user\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        Yii::setAlias("@user", __DIR__);
        // Setup i18n compoment for translate all category user*
        if (!isset(Yii::$app->get('i18n')->translations['user*'])) {
            Yii::$app->get('i18n')->translations['user*'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => __DIR__ . '/messages',
            ];
        }        
        $this->_views = ArrayHelper::merge($this->_views, $this->views);  
    }  
    
    public function getLoginFieldName(){
        return ($this->loginScenario == 'EMAIL') ? 'email': 'username';
    }
    
    public function getView($name){
        return $this->_views[$name];
    }
    
    public function getModel($name){
        return $this->_models[$name];
    }    
}
