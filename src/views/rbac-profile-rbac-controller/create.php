<?php

use antonyz89\rbac\models\RbacFunctionality;
use yii\web\View;

/**
 * @var $this View
 * @var $model RbacFunctionality
 */

$this->title = 'Create Functionality'
?>

<div class="functionality-create">
    <?= $this->render('_form', [
        'model' => $model
    ]) ?>
</div>
