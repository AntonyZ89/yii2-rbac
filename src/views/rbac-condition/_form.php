<?php

use antonyz89\rbac\models\RbacCondition;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/**
 * @var $this View
 * @var $model RbacCondition
 */

?>

<div class="rbac-condition-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body">
        <div class="row">
            <?php if ($model->rbac_condition_id): ?>
                <div class="col">
                    <?= $form->field($model, 'logical_operator')->widget(Select2::class, [
                        'data' => RbacCondition::valuesLogicalOperator(),
                        'hideSearch' => true,
                        'theme' => Select2::THEME_DEFAULT,
                        'options' => ['placeholder' => Yii::t('app', 'Selecione')]
                    ]) ?>
                </div>
            <?php endif; ?>
            <div class="col">
                <?= $form->field($model, 'param') ?>
            </div>
            <div class="col">
                <?= $form->field($model, 'operator')->widget(Select2::class, [
                    'data' => RbacCondition::valuesOperator(),
                    'hideSearch' => true,
                    'theme' => Select2::THEME_DEFAULT,
                    'options' => ['placeholder' => Yii::t('app', 'Select')]
                ]) ?>
            </div>
            <div class="col">
                <?= $form->field($model, 'value') ?>
            </div>
        </div>
    </div>

    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-plus"></i> ' . Yii::t('app', 'Create') : '<i class="fas fa-sync-alt"></i> ' . Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
