<?php

use antonyz89\rbac\models\RbacBlock;
use yii\web\View;

/**
 * @var $this View
 * @var $model RbacBlock
 */

$this->title = 'Update Block'
?>

<div class="rbac-block-update">
    <?= $this->render('_form', [
        'model' => $model
    ]) ?>
</div>
