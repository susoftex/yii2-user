<?php
/**
 * @author Yuriy Basov <basowy@gmail.com>
 * @since 1.0.0
 */
use yii2x\user\widgets\Message;
use yii2x\user\widgets\UsernameEmailForm;

?>
<h1>Password Request</h1>
<?= Message::widget(); ?>
<?= UsernameEmailForm::widget([
    'model' => $model,
]) ?>