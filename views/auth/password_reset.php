<?php
/**
 * @author Yuriy Basov <basowy@gmail.com>
 * @since 1.0.0
 */
use yii2x\user\widgets\Message;
use yii2x\user\widgets\PasswordResetForm;

?>
<h1>Password Reset</h1>
<?= Message::widget(); ?>
<?= PasswordResetForm::widget([
    'model' => $model,
]) ?>