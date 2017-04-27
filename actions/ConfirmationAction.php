<?php
/**
 * @author Yuriy Basov <basowy@gmail.com>
 * @since 1.0.0
 */

namespace yii2x\user\actions;

use Yii;
use yii\base\Action;
use yii\db\Expression;
use yii2x\user\models\User;

class ConfirmationAction extends Action
{
    public $view = '@vendor/yii2x/yii2-user/views/auth/message';
    
    public function run($token)
    {
 
        $model = User::find()->where([
            'confirm_token' => $token,
        ])->andWhere([
            '>', new Expression('TIMEDIFF(`confirm_expired_at`,UTC_TIMESTAMP())'), new Expression('TIME("00:00:00")')
        ])->one();
        
        if(!empty($model->id)){
            
            $model->confirm_expired_at = null;
            $model->confirm_token = null;
            $model->confirmed_at = new Expression('UTC_TIMESTAMP()');
            
            $model->save();
            
            Yii::$app->session->setFlash('success', 'Thank you, registration is now completed.');
        }
        else{
            Yii::$app->session->setFlash('failure', 'The confirmation link is invalid or expired. Please request a new one.');
        }

        return $this->controller->render($this->view, [

        ]);        
    }    
}

