<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $controllers \antonyz89\rbac\models\Controller[] */
/* @var $content string */

$controllers = Yii::$app->controller->module->controllers;

$this->title = 'Welcome to RBAC Manager';
?>
<div class="default-index">
    <h1>Welcome to Gii <small class="text-muted">a magical tool that can write code for you</small></h1>

    <p class="lead mb-5">Start the fun with the following code generators:</p>

    <div class="row">
        <?php foreach ($controllers as $id => $controller): ?>
        <div class="controller col-md-3">
            <h3><?= Html::encode($id) ?></h3>
            <p><?= Html::a('View &raquo;', ['default/view', 'id' => $id], ['class' => 'btn btn-primary']) ?></p>
        </div>
        <?php endforeach; ?>
    </div>
</div>
