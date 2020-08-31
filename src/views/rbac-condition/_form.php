<?php

use antonyz89\rbac\models\RbacCondition;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var $this View
 * @var $model RbacCondition
 */

$showLogicalOperator = $model->scenario === RbacCondition::SCENARIO_CHILD;
?>

<div class="rbac-condition-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body">
        <div class="row">
            <?php if ($showLogicalOperator): ?>
                <div class="col">
                    <?= $form->field($model, 'logical_operator')->widget(Select2::class, [
                        'data' => RbacCondition::valuesLogicalOperator(),
                        'disabled' => $model->rbacConditionParent && $model->rbacConditionParent->logical_operator && !$model->rbacConditionParent->rbacBlock,
                        'hideSearch' => true,
                        'theme' => Select2::THEME_DEFAULT,
                        'options' => ['placeholder' => Yii::t('app', 'Select')]
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
        <div class="row">
            <div class="offset-<?= $showLogicalOperator ? 9 : 8 ?> col-<?= $showLogicalOperator ? 3 : 4 ?>">
                <?= $form->field($model, 'value_type')->widget(Select2::class, [
                    'data' => RbacCondition::valuesValueType(),
                    'hideSearch' => true,
                    'theme' => Select2::THEME_DEFAULT,
                    'options' => ['placeholder' => Yii::t('app', 'Select')],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ]
                ]) ?>
            </div> <!-- /.offset-X .col-X -->
        </div>
    </div>

    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-plus"></i> ' . Yii::t('app', 'Create') : '<i class="fas fa-sync-alt"></i> ' . Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php if (!$model->isNewRecord): ?>
        <?= Html::a('<i class="fas fa-times"></i> ' . Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ]
            ]) ?>
        <?php endif; ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<?php
$js = /** @lang JavaScript */
    "
$('#rbaccondition-value_type').change(function () {
    if(Number($(this).val()) === " . RbacCondition::VALUE_TYPE_NULL . ") {
        $('#rbaccondition-value').val(null).prop('disabled', true);
    } else {
        $('#rbaccondition-value').prop('disabled', false);
    }
});
";

$this->registerJs($js);
?>
