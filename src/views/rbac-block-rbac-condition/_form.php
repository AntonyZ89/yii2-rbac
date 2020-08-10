<?php

use antonyz89\rbac\models\RbacBlockRbacCondition;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var $this View
 * @var $rbacBlockRbacConditionModel RbacBlockRbacCondition
 * @var $conditionModel RbacBlockRbacCondition
 */

?>

<div class="rbac-block-rbac-condition-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body">
        
    </div>

    <div class="box-footer">
        <?= Html::submitButton($rbacBlockRbacConditionModel->isNewRecord ? '<i class="fa fa-plus"></i> Create' : '<i class="fas fa-sync-alt"></i> Update', ['class' => $rbacBlockRbacConditionModel->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
