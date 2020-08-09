<?php

use antonyz89\rbac\models\RbacProfileRbacController;
use yii\web\View;

/**
 * @var $this View
 * @var $model RbacProfileRbacController
 */

$this->title = 'Create Controller'
?>

<div class="rbac-profile-rbac-controller-create">
    <?= $this->render('_form', [
        'model' => $model
    ]) ?>
</div>
