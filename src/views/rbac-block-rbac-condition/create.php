<?php

use antonyz89\rbac\models\RbacBlockRbacCondition;
use yii\web\View;

/**
 * @var $this View
 * @var $model RbacBlockRbacCondition
 */

$this->title = Yii::t('app', 'Create Condition')
?>

<div class="rbac-block-rbac-condition-create">
    <?= $this->render('_form', [
        'model' => $model
    ]) ?>
</div>
