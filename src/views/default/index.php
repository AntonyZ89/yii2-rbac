<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $controllers \antonyz89\rbac\models\RbacController[] */
/* @var $content string */

$controllers = Yii::$app->controller->module->controllers;

$this->title = 'Welcome to RBAC Manager';
?>
<div class="default-index">
    <h1>Welcome to Gii <small class="text-muted">a magical tool that can write code for you</small></h1>

    <p class="lead mb-5">Start the fun with the following code generators:</p>

    <div class="row">
        <?php foreach ($controllers as $controller): ?>
            <div class="col-md-4">
                <div class="controller">
                    <div class="clearfix">
                        <h4 class="float-left"><?= $controller->name ?></h4>
                        <?= Html::a('<i class="fas fa-plus"></i>', ['default/create-functionality', 'id' => $controller->id], [
                            'class' => 'btn btn-sm btn-outline-primary float-right show-modal',
                            'data' => [
                                'header' => 'Funcionality',
                                'target' => '#modal'
                            ]
                        ]) ?>
                    </div>

                    <?php foreach ($controller->rbacFunctionalities as $rbacFunctionality): ?>
                        <div class="functionality">
                            <div class="clearfix">
                            <h4 class="float-left"><?= $rbacFunctionality->name ?> (<?= $rbacFunctionality->rule ?>)</h4>
                            <?= Html::a('<i class="fas fa-plus"></i>', ['default/create-action', 'id' => $rbacFunctionality->id], [
                                'class' => 'btn btn-sm btn-outline-success float-right show-modal',
                                'data' => [
                                    'header' => 'Action',
                                    'target' => '#modal'
                                ]
                            ]) ?>
                            <?= Html::a('<i class="fas fa-pencil-alt"></i>', ['default/update-functionality', 'id' => $rbacFunctionality->id], [
                                'class' => 'btn btn-sm btn-outline-secondary float-right show-modal',
                                'data' => [
                                    'header' => 'Action',
                                    'target' => '#modal'
                                ]
                            ]) ?>
                            <?= Html::a('<i class="fas fa-times"></i>', ['default/delete-functionality', 'id' => $rbacFunctionality->id], [
                                'class' => 'btn btn-sm btn-outline-danger float-right show-modal',
                                'data' => [
                                    'header' => 'Action',
                                    'target' => '#modal'
                                ]
                            ]) ?>
                            </div>

                            <p><?= $rbacFunctionality->description ?></p>
                            <ol>
                                <?php foreach ($rbacFunctionality->rbacActions as $rbacAction): ?>
                                    <li class="clearfix">
                                        <?= $rbacAction->name ?>
                                        <?= Html::a('<i class="fas fa-times"></i>', ['default/delete-action', 'id' => $rbacAction->id], [
                                            'class' => 'btn btn-sm btn-outline-danger float-right show-modal',
                                            'data' => [
                                                'header' => 'Action',
                                                'target' => '#modal'
                                            ]
                                        ]) ?>

                                    </li>
                                <?php endforeach; ?>
                            </ol>
                        </div>
                    <?php endforeach; ?>
                    <?php /*
                <p><?= Html::a('View &raquo;', ['default/view', 'id' => $controller->id], ['class' => 'btn btn-primary']) ?></p>
                */ ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<?php
$css = <<< CSS
.controller, .functionality {
    padding: 10px;
    border: 1px solid black;
    margin-bottom: 10px;
}

.btn-outline-secondary {
    margin: 0 3px;
}

.btn-outline-danger {
    padding: 0.25rem 0.6rem;
}

.modal-header {
    flex-direction: row-reverse;
}

CSS;

$this->registerCss($css);
?>
