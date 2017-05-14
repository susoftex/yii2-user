<?php
/**
 * @author Yuriy Basov <basowy@gmail.com>
 * @since 1.0.0
 */
use yii2x\user\widgets\Message;
use yii2x\user\widgets\UsernameSigninForm;

?>
<h1>Sign In</h1>
<?= Message::widget(); ?>
<?= UsernameSigninForm::widget([
    'model' => $model,
]);

?>

