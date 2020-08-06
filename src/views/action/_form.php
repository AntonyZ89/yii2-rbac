<?php

use antonyz89\rbac\models\RbacFunctionalityRbacAction;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var $this View
 * @var $model RbacFunctionalityRbacAction
 */

?>

<div class="rbac-functionality-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body">
        <?= $form->field($model, 'rbac_action_id')->widget(Select2::class, [
            'data' => $model->rbac_action_id ? [$model->rbac_action_id => (string)  $model->rbacAction] : [],
            'theme' => Select2::THEME_DEFAULT,
            'options' => ['placeholder' => 'Select'],
            'pluginOptions' => [
                'ajax' => [
                    'url' => Url::toRoute(['default/search-action', 'functionality_id' => $model->rbac_functionality_id]),
                    'dataType' => 'json'
                ],
            ],
        ]) ?>
    </div>

    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-plus"></i> Create' : '<i class="fas fa-sync-alt"></i> Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
