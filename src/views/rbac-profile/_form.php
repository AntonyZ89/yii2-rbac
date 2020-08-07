<?php

use antonyz89\rbac\models\RbacProfile;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model RbacProfile */
/* @var $form ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

<?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-plus"></i> ' . 'Save' : '<i class="fa fas fa-sync-alt"></i> ' . 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>
