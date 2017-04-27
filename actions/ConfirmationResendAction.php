<?php
/**
 * @author Yuriy Basov <basowy@gmail.com>
 * @since 1.0.0
 */

namespace yii2x\user\actions;

use Yii;
use yii\base\Action;
use yii2x\user\models\ConfirmationResendEmailForm;

class ConfirmationResendAction extends Action
{
    public $view = '@vendor/yii2x/yii2-user/views/auth/confirmation_resend';
    
    public function run()
    {

        $model = new ConfirmationResendEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->initConfirmation()) { 
            Yii::$app->session->setFlash('success', Yii::t('app', 'Confirmation email sent to') . ' ' . $model->_user->email);
            return $this->controller->redirect(Yii::$app->user->loginUrl);  
        }        
        
        return $this->controller->render($this->view, [
            'model' => $model,
        ]);          
    }    
}

