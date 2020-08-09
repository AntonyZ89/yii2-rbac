<?php

use antonyz89\rbac\models\RbacProfileRbacController;
use yii\web\View;

/**
 * @var $this View
 * @var $model RbacProfileRbacController
 */

$this->title = 'Update Controller'
?>

<div class="rbac-profile-rbac-controller-update">
    <?= $this->render('_form', [
        'model' => $model
    ]) ?>
</div>
