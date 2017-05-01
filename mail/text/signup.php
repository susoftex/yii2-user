<?php
/**
 * @author Yuriy Basov <basowy@gmail.com>
 * @since 1.0.0
 */
?>

<?= Yii::t('app', 'Hello') ?>,
<?= Yii::t('app', 'Thank you for signing up on {0}', Yii::$app->name) ?>.
<?= Yii::t('app', 'In order to complete your registration, please click the link below') ?>.
<?= $url ?>.
<?= Yii::t('app', 'If you cannot click the link, please copy and paste the text into your browser') ?>.
<?= Yii::t('app', 'If you did not make this request you can ignore this email') ?>.