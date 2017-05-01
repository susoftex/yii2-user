<?php
/**
 * @author Yuriy Basov <basowy@gmail.com>
 * @since 1.0.0
 */
?>
    <?php if (\Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success alert-dismissable"> 
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
            <strong><span style="font-size:16px" class="glyphicon glyphicon-ok-circle"></span></strong>
            <?= \Yii::$app->session->getFlash('success'); ?>
        </div>
    <?php endif; ?>   
    <?php if (\Yii::$app->session->hasFlash('failure')): ?>
        <div class="alert alert-danger alert-dismissable"> 
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
            <strong><span style="font-size:16px" class="glyphicon glyphicon-remove-circle"></span></strong>
            <?= \Yii::$app->session->getFlash('failure'); ?>
        </div>
    <?php endif; ?>   
