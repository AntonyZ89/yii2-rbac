<?php

use antonyz89\rbac\models\RbacBlock;
use yii\web\View;

/**
 * @var $this View
 * @var $model RbacBlock
 */

$this->title = 'Create Block'
?>

<div class="rbac-block-create">
    <?= $this->render('_form', [
        'model' => $model
    ]) ?>
</div>
