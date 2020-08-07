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
<div class="rbac-profile-update card">
    <div class="card-body">
        <?= $this->render('_form', [
            'model' => $model
        ]) ?>

        <?= Html::a('Add Controller', ['rbac-profile-rbac-controller/create', 'profile_id' => $model->id], [
            'class' => 'btn btn-success show-modal',
            'data' => [
                'header' => 'Controller',
                'target' => '#modal'
            ]
        ]) ?>

        <div class="row">
            <?php foreach ($controllers as $controller): ?>
            <?php $rbacController = $controller->rbacController ?>
                <div class="col-md-4">
                    <div class="controller">
                        <div class="clearfix">
                            <h4 class="float-left"><?= $rbacController->name ?></h4>
                            <?= Html::a('<i class="fas fa-plus"></i>', ['rbac-functionality/create', 'profile_id' => $controller->rbac_profile_id, 'controller_id' => $controller->rbac_controller_id], [
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
                                    <h4 class="float-left"><?= $rbacFunctionality->name ?>
                                        (<?= $rbacFunctionality->rule ?>)</h4>
                                    <?= Html::a('<i class="fas fa-plus"></i>', ['rbac-functionality-rbac-action/create', 'functionality_id' => $rbacFunctionality->id], [
                                        'class' => 'btn btn-sm btn-outline-success float-right show-modal',
                                        'data' => [
                                            'header' => 'Action',
                                            'target' => '#modal'
                                        ]
                                    ]) ?>
                                    <?= Html::a('<i class="fas fa-pencil-alt"></i>', ['rbac-functionality/update', 'id' => $rbacFunctionality->id], [
                                        'class' => 'btn btn-sm btn-outline-secondary float-right show-modal',
                                        'data' => [
                                            'header' => 'Action',
                                            'target' => '#modal'
                                        ]
                                    ]) ?>
                                    <?= Html::a('<i class="fas fa-times"></i>', ['rbac-functionality/delete', 'id' => $rbacFunctionality->id], [
                                        'class' => 'btn btn-sm btn-outline-danger float-right show-modal',
                                        'data' => [
                                            'header' => 'Action',
                                            'target' => '#modal'
                                        ]
                                    ]) ?>
                                </div>

                                <p><?= $rbacFunctionality->description ?></p>
                                <ol class="actions">
                                    <?php foreach ($rbacFunctionality->rbacFunctionalityRbacActions as $rbacFunctionalityRbacAction): ?>
                                        <li class="clearfix">
                                            <?= $rbacFunctionalityRbacAction->rbacAction->name ?>
                                            <?= Html::a('<i class="fas fa-times"></i>', ['rbac-functionality-rbac-action/delete', 'rbac_functionality_id' => $rbacFunctionalityRbacAction->rbac_functionality_id, 'rbac_action_id' => $rbacFunctionalityRbacAction->rbac_action_id], [
                                                'class' => 'btn btn-sm btn-outline-danger float-right show-modal',
                                                'data' => [
                                                    'header' => 'Action',
                                                    'target' => '#modal'
                                                ]
                                            ]) ?>
                                            <?= Html::a('<i class="fas fa-pencil-alt"></i>', ['rbac-functionality-rbac-action/update', 'rbac_functionality_id' => $rbacFunctionalityRbacAction->rbac_functionality_id, 'rbac_action_id' => $rbacFunctionalityRbacAction->rbac_action_id], [
                                                'class' => 'btn btn-sm btn-outline-secondary float-right show-modal',
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
</div>
