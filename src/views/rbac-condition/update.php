<?php

use antonyz89\rbac\models\RbacCondition;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var $this View
 * @var $model RbacCondition
 */

$this->title = Yii::t('app', 'Condition')
?>

<div class="rbac-condition-update">
    <?= $this->render('_form', [
        'model' => $model
    ]) ?>
</div>
