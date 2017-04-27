<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('user', 'Sign in');

?>
    <?php
    \yii\widgets\Pjax::begin();
    ?>
                <?php $form = ActiveForm::begin([
                    'options' => ['data' => [ 'pjax' => true]],
                    'id'                     => 'login-form',
                    'enableAjaxValidation'   => false,
                    'enableClientValidation' => false,
                    'validateOnBlur'         => false,
                    'validateOnType'         => false,
                    'validateOnChange'       => false,
                ]) ?>

                <?php if (\Yii::$app->controller->module->loginScenario == 'EMAIL'): ?>
                    <?= $form->field($model, 'email', ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1']]) ?>
                <?php else: ?> 
                    <?= $form->field($model, 'username', ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1']]) ?>
                <?php endif ?> 
                    
                

                <?= $form->field($model, 'password', ['inputOptions' => ['class' => 'form-control', 'tabindex' => '2']])->passwordInput()->label(Yii::t('user', 'Password')) ?>
                <?= $form->field($model, 'rememberMe')->checkbox(['tabindex' => '4']) ?>


                <?= Html::submitButton(Yii::t('user', '<i class="fa fa-fw fa-refresh fa-spin hidden"></i><span> Sign in</span>'), ['class' => 'btn btn-primary btn-block', 'tabindex' => '3']) ?>

                <?php ActiveForm::end(); ?>
    <?php
    \yii\widgets\Pjax::end();
    ?>