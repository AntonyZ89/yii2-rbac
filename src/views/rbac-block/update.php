<?php

use antonyz89\rbac\models\RbacBlock;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var $this View
 * @var $model RbacBlock
 */

$this->title = Yii::t('app', 'Update Block');
?>

<p>
    <?= Html::a('<i class="fas fa-angle-left"></i> ' . 'Back', ['rbac-profile/update', 'id' => $model->rbac_profile_id], ['class' => 'btn btn-primary']) ?>
</p>

<div class="rbac-block-update card">
    <div class="card-body">
        <?= $this->render('_form', [
            'model' => $model
        ]) ?>

        <hr>

        <p>
            <?= Html::a('<i class="fas fa-project-diagram"></i> ' . Yii::t('app', 'Add a condition'), ['rbac-condition/create', 'rbac_block_id' => $model->id], [
                'class' => 'btn btn-success show-modal',
                'data' => [
                    'target' => '#modal-lg',
                    'header' => Yii::t('app', 'Condition')
                ]
            ]) ?>
        </p>

        <?php foreach ($model->rbacBlockRbacConditions as $rbacBlockRbacCondition): ?>
            <?php if (($rbacCondition = $rbacBlockRbacCondition->rbacCondition)->logical_operator): ?>
                <p>
                    <b><?= $rbacCondition->logicalOperatorText ?></b>
                </p>
            <?php endif; ?>
            <div class="card">
                <div class="card-body">
                    <div class="d-inline-block">
                        <?= Html::a($rbacCondition, ['rbac-condition/update', 'id' => $rbacCondition->id], [
                            'class' => 'show-modal',
                            'data' => [
                                'header' => Yii::t('app', 'Update'),
                                'target' => '#modal-lg'
                            ]
                        ]) ?>
                    </div>

                    <?php while ($rbacCondition): ?>
                        <?php $last_id = $rbacCondition->id; ?>
                        <?php if ($rbacCondition = $rbacCondition->rbacCondition): ?>
                            <?php if ($rbacCondition->logical_operator): ?>
                                <b><?= $rbacCondition->logicalOperatorText ?></b>
                            <?php endif; ?>
                            <div class="d-inline-block">
                                <?= Html::a($rbacCondition, ['rbac-condition/update', 'id' => $rbacCondition->id], [
                                    'class' => 'show-modal',
                                    'data' => [
                                        'header' => Yii::t('app', 'Update'),
                                        'target' => '#modal-lg'
                                    ]

                                ]) ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!$rbacCondition): ?>
                            <?= Html::a('<i class="fas fa-plus"></i>', ['rbac-condition/create', 'rbac_condition_id' => $last_id], [
                                'class' => 'btn btn-sm btn-outline-primary show-modal',
                                'data' => [
                                    'header' => Yii::t('app', 'Additional Condition'),
                                    'target' => '#modal-lg'
                                ]
                            ]) ?>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
