<?php
/**
 * @author Yuriy Basov <basowy@gmail.com>
 * @since 1.0.0
 */
use yii2x\user\widgets\Message;
use yii2x\user\widgets\VerificationCodeForm;

?>
<h1>Your Username</h1>
<?= Message::widget(); ?>
<?= VerificationCodeForm::widget([
    'model' => $model,
]) ?>