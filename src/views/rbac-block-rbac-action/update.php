<?php

use antonyz89\rbac\models\RbacBlockRbacAction;
use yii\web\View;

/**
 * @var $this View
 * @var $model RbacBlockRbacAction
 */

$this->title = Yii::t('app', 'Update Action')
?>

<div class="rbac-block-rbac-action-update">
    <?= $this->render('_form', [
        'model' => $model
    ]) ?>
</div>
