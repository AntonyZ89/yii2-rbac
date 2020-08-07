<?php

use antonyz89\rbac\models\search\RbacProfileSearch;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $searchModel RbacProfileSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = 'Profiles';
$this->params['breadcrumbs'][] = $this->title;

$columns = [
    'id',
    'name',
    'description'
];

?>
<div class="rbac-profile-index card">
    <div class="card-header">
        <?= Html::a('Create Profile', ['rbac-profile/create'], [
            'class' => 'btn btn-success show-modal',
            'data' => [
                'header' => 'Profile',
                'target' => '#modal'
            ]
        ]) ?>
    </div>
    <div class="card-body">
        <?= $this->render('_search', ['model' => $searchModel]) ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'summary' => false,
            'columns' => ArrayHelper::merge($columns, [
                [
                    'class' => '\yii\grid\ActionColumn',
                    'visibleButtons' => ['view' => false]
                ]
            ])
        ]); ?>

    </div>
</div>
