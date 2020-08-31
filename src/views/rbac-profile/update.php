<?php

use antonyz89\rbac\models\RbacProfile;
use antonyz89\rbac\models\RbacProfileRbacController;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $model RbacProfile */
/* @var $controllers RbacProfileRbacController[] */

$this->title = 'Update';
$this->params['breadcrumbs'][] = ['label' => 'Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<p>
    <?= Html::a('<i class="fas fa-angle-left"></i> ' . 'Back', ['rbac-profile/index'], ['class' => 'btn btn-primary']) ?>
</p>

<div class="rbac-profile-update card">
    <div class="card-body">
        <?= $this->render('_form', [
            'model' => $model
        ]) ?>

        <hr>

        <p>
            <?= Html::a('<i class="fa fa-plus"></i> ' . 'Controller', ['rbac-profile-rbac-controller/create', 'rbac_profile_id' => $model->id], [
                'class' => 'btn btn-success show-modal',
                'data' => [
                    'header' => 'Controller',
                    'target' => '#modal'
                ]
            ]) ?>
        </p>

        <div class="row">
            <?php foreach ($controllers as $controller): ?>
                <?php $rbacController = $controller->rbacController ?>
                <div class="col-md-6">
                    <div class="controller">
                        <div class="clearfix">
                            <div class="clearfix">
                                <h4 class="float-left"><?= $rbacController->name ?></h4>
                                <div class="float-right">
                                    <?= Html::a('<i class="fas fa-plus"></i>', ['rbac-block/create', 'profile_id' => $controller->rbac_profile_id, 'controller_id' => $controller->rbac_controller_id], [
                                        'class' => 'btn btn-sm btn-outline-primary show-modal',
                                        'data' => [
                                            'header' => 'Block',
                                            'target' => '#modal'
                                        ]
                                    ]) ?>
                                    <?= Html::a('<i class="fas fa-pencil-alt"></i>', ['rbac-profile-rbac-controller/update', 'rbac_profile_id' => $controller->rbac_profile_id, 'rbac_controller_id' => $controller->rbac_controller_id], [
                                        'class' => 'btn btn-sm btn-outline-secondary show-modal',
                                        'data' => [
                                            'header' => 'Action',
                                            'target' => '#modal'
                                        ]
                                    ]) ?>
                                    <?= Html::a('<i class="fas fa-times"></i>', ['rbac-profile-rbac-controller/delete', 'id' => $rbacController->id], [
                                        'class' => 'btn btn-sm btn-outline-danger show-modal',
                                        'data' => [
                                            'header' => 'Action',
                                            'target' => '#modal'
                                        ]
                                    ]) ?>
                                </div>
                            </div>
                            <h4 class="float-left text-muted">(<?= $rbacController->application ?>)</h4>
                        </div>

                        <?php foreach ($controller->rbacBlocks as $rbacBlock): ?>
                            <div class="block">
                                <div class="clearfix">
                                    <div class="clearfix">
                                        <h4 class="float-left"><?= $rbacBlock->name ?></h4>
                                        <div class="float-right">
                                            <?= Html::a('<i class="fas fa-plus"></i>', ['rbac-block-rbac-action/create', 'rbac_block_id' => $rbacBlock->id], [
                                                'class' => 'btn btn-sm btn-outline-success show-modal',
                                                'data' => [
                                                    'header' => 'Action',
                                                    'target' => '#modal'
                                                ]
                                            ]) ?>
                                            <?= Html::a('<i class="fas fa-pencil-alt"></i>', ['rbac-block/update', 'id' => $rbacBlock->id], ['class' => 'btn btn-sm btn-outline-secondary']) ?>
                                            <?= Html::a('<i class="fas fa-times"></i>', ['rbac-block/delete', 'id' => $rbacBlock->id], [
                                                'class' => 'btn btn-sm btn-outline-danger show-modal',
                                                'data' => [
                                                    'header' => 'Action',
                                                    'target' => '#modal'
                                                ]
                                            ]) ?>
                                        </div>
                                    </div>

                                    <h4 class="float-left text-muted">(<?= $rbacBlock->rule ?>)</h4>
                                </div>
                                <small>
                                    <?= $rbacBlock->conditionText ?>
                                </small>

                                <p><?= $rbacBlock->description ?></p>
                                <ol class="actions">
                                    <?php foreach ($rbacBlock->rbacBlockRbacActions as $rbacBlockRbacAction): ?>
                                        <li class="clearfix">
                                            <?= $rbacBlockRbacAction->rbacAction->name ?>
                                            <div class="float-right">
                                                <?= Html::a('<i class="fas fa-pencil-alt"></i>', ['rbac-block-rbac-action/update', 'rbac_block_id' => $rbacBlockRbacAction->rbac_block_id, 'rbac_action_id' => $rbacBlockRbacAction->rbac_action_id], [
                                                    'class' => 'btn btn-sm btn-outline-secondary show-modal',
                                                    'data' => [
                                                        'header' => 'Action',
                                                        'target' => '#modal'
                                                    ]
                                                ]) ?>
                                                <?= Html::a('<i class="fas fa-times"></i>', ['rbac-block-rbac-action/delete', 'rbac_block_id' => $rbacBlockRbacAction->rbac_block_id, 'rbac_action_id' => $rbacBlockRbacAction->rbac_action_id], [
                                                    'class' => 'btn btn-sm btn-outline-danger show-modal',
                                                    'data' => [
                                                        'header' => 'Action',
                                                        'target' => '#modal'
                                                    ]
                                                ]) ?>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
