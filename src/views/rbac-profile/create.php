<?php

use antonyz89\rbac\models\RbacProfile;
use yii\web\View;

/* @var $this View */
/* @var $model RbacProfile */

$this->title = 'Create Profile';
$this->params['breadcrumbs'][] = ['label' => 'Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rbac-profile-create">
    <?= $this->render('_form', [
        'model' => $model
    ]) ?>
</div>
