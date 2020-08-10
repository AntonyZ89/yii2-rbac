<?php

use antonyz89\rbac\models\RbacCondition;
use yii\web\View;

/**
 * @var $this View
 * @var $model RbacCondition
 */

$this->title = Yii::t('app', 'Create Condition')
?>

<div class="rbac-condition-create">
    <?= $this->render('_form', [
        'model' => $model
    ]) ?>
</div>
