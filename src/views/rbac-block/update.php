<?php

use antonyz89\rbac\models\RbacBlock;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var $this View
 * @var $model RbacBlock
 */

$this->title = Yii::t('app', 'Update Block')
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
            <div class="card">
                <div class="card-body">
                    <div>
                        <?= (string)($rbacCondition = $rbacBlockRbacCondition->rbacCondition) ?>
                    </div>
                    <?php while (true): ?>
                        <?php if ($rbacCondition = $rbacCondition->rbacCondition): ?>
                            <div>
                                <?= (string)$rbacCondition ?>
                            </div>
                        <?php else: ?>
                            <?php break; ?>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
