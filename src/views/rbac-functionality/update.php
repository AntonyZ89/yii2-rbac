<?php

use antonyz89\rbac\models\RbacFunctionality;
use yii\web\View;

/**
 * @var $this View
 * @var $model RbacFunctionality
 */

$this->title = 'Update Functionality'
?>

<div class="functionality-update">
    <?= $this->render('_form', [
        'model' => $model
    ]) ?>
</div>
