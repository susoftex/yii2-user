<?php
/**
 * @author Yuriy Basov <basowy@gmail.com>
 * @since 1.0.0
 */
?>

<?= Yii::t('app', 'Hello') ?>,
<?= Yii::t('app', 'We have received a confirmation of your request to reset the password for your account at {0}', Yii::$app->name) ?>.
<?= Yii::t('app', 'Here is your new password') ?>.
<?= Yii::t('app', 'New Password: {0}',$password) ?>.
<?= Yii::t('app', 'Please change password after you login for security.') ?>.
