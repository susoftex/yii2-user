<?php
/**
 * @author Yuriy Basov <basowy@gmail.com>
 * @since 1.0.0
 */
?>

<?= Yii::t('app', 'Hello') ?>,

<?= Yii::t('app', 'We have received a request to reset the password for your account on {0}', Yii::$app->name) ?>.
<?= Yii::t('app', 'Please click the link below to complete your password reset') ?>.

<?= $url ?>

<?= Yii::t('app', 'If you cannot click the link, please try pasting the text into your browser') ?>.

<?= Yii::t('app', 'If you did not make this request you can ignore this email') ?>.