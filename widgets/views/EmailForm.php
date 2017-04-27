<?php
/**
 * @author Yuriy Basov <basowy@gmail.com>
 * @since 1.0.0
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
?>

    <?php
    Pjax::begin();
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


                <?= $form->field($model, 'email', ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1']]) ?>


                <?= Html::submitButton('<i class="fa fa-fw fa-refresh fa-spin hidden"></i><span> '.Yii::t('app', 'Submit') . '</span>', ['class' => 'btn btn-primary btn-block', 'tabindex' => '3']) ?>

                <?php ActiveForm::end(); ?>
    <?php
    \yii\widgets\Pjax::end();
    ?>
