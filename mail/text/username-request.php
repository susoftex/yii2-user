<?php
/**
 * @author Yuriy Basov <basowy@gmail.com>
 * @since 1.0.0
 */
?>

<?= Yii::t('app', 'Hello') ?>,

<?= Yii::t('app', 'We have received a request for username for your account on {0}', Yii::$app->name) ?>.
<?= Yii::t('app', 'Please click the link below to complete your username request.') ?>.

<?= $url ?>

<?= Yii::t('app', 'If you cannot click the link, please copy and paste the text into your browser') ?>.

<?= Yii::t('app', 'If you did not make this request you can ignore this email') ?>.