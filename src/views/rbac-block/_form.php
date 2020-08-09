<?php

use antonyz89\rbac\models\RbacBlock;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var $this View
 * @var $model RbacBlock
 */

?>

<div class="rbac-block-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'name') ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'rule') ?>
            </div>
            <div class="col-md-12">
                <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
            </div>
        </div>
    </div>

    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-plus"></i> Create' : '<i class="fas fa-sync-alt"></i> Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
