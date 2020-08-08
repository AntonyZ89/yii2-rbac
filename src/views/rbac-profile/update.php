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

        <div class="form-group">
            <?= Html::a('<i class="fa fa-plus"></i> ' . 'Controller', ['rbac-profile-rbac-controller/create', 'rbac_profile_id' => $model->id], [
                'class' => 'btn btn-success show-modal',
                'data' => [
                    'header' => 'Controller',
                    'target' => '#modal'
                ]
            ]) ?>
        </div>

        <div class="row">
            <?php foreach ($controllers as $controller): ?>
                <?php $rbacController = $controller->rbacController ?>
                <div class="col-md-4">
                    <div class="controller">
                        <div>
                            <h4 class="float-left"><?= $rbacController->name ?></h4>
                            <div class="float-right">
                                <?= Html::a('<i class="fas fa-plus"></i>', ['rbac-functionality/create', 'profile_id' => $controller->rbac_profile_id, 'controller_id' => $controller->rbac_controller_id], [
                                    'class' => 'btn btn-sm btn-outline-primary show-modal',
                                    'data' => [
                                        'header' => 'Funcionality',
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
                            <div class="clearfix"></div>
                        </div>

                        <?php foreach ($controller->rbacFunctionalities as $rbacFunctionality): ?>
                            <div class="functionality">
                                <div>
                                    <h4 class="float-left"><?= $rbacFunctionality->name ?></h4>
                                    <div class="float-right">
                                        <?= Html::a('<i class="fas fa-plus"></i>', ['rbac-functionality-rbac-action/create', 'functionality_id' => $rbacFunctionality->id], [
                                            'class' => 'btn btn-sm btn-outline-success show-modal',
                                            'data' => [
                                                'header' => 'Action',
                                                'target' => '#modal'
                                            ]
                                        ]) ?>
                                        <?= Html::a('<i class="fas fa-pencil-alt"></i>', ['rbac-functionality/update', 'id' => $rbacFunctionality->id], [
                                            'class' => 'btn btn-sm btn-outline-secondary show-modal',
                                            'data' => [
                                                'header' => 'Action',
                                                'target' => '#modal'
                                            ]
                                        ]) ?>
                                        <?= Html::a('<i class="fas fa-times"></i>', ['rbac-functionality/delete', 'id' => $rbacFunctionality->id], [
                                            'class' => 'btn btn-sm btn-outline-danger show-modal',
                                            'data' => [
                                                'header' => 'Action',
                                                'target' => '#modal'
                                            ]
                                        ]) ?>
                                    </div>
                                    <h4 class="float-left">(<?= $rbacFunctionality->rule ?>)</h4>
                                    <div class="clearfix"></div>
                                </div>

                                <p><?= $rbacFunctionality->description ?></p>
                                <ol class="actions">
                                    <?php foreach ($rbacFunctionality->rbacFunctionalityRbacActions as $rbacFunctionalityRbacAction): ?>
                                        <li class="clearfix">
                                            <?= $rbacFunctionalityRbacAction->rbacAction->name ?>
                                            <div class="float-right">
                                                <?= Html::a('<i class="fas fa-pencil-alt"></i>', ['rbac-functionality-rbac-action/update', 'rbac_functionality_id' => $rbacFunctionalityRbacAction->rbac_functionality_id, 'rbac_action_id' => $rbacFunctionalityRbacAction->rbac_action_id], [
                                                    'class' => 'btn btn-sm btn-outline-secondary show-modal',
                                                    'data' => [
                                                        'header' => 'Action',
                                                        'target' => '#modal'
                                                    ]
                                                ]) ?>
                                                <?= Html::a('<i class="fas fa-times"></i>', ['rbac-functionality-rbac-action/delete', 'rbac_functionality_id' => $rbacFunctionalityRbacAction->rbac_functionality_id, 'rbac_action_id' => $rbacFunctionalityRbacAction->rbac_action_id], [
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
