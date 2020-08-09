<?php

use antonyz89\rbac\models\search\RbacProfileSearch;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use yii\data\ActiveDataProvider;
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
<div class="form-group">
    <?= Html::a('Generate Migration', ['generator/index'], ['class' => 'btn btn-info']) ?> <span class="text-muted">Create a migration with current rbac data</span>
</div>

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
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => ArrayHelper::merge($columns, [
                [
                    'class' => ActionColumn::class,
                    'visibleButtons' => ['view' => false],
                    'width' => '100px',
                    'updateOptions' => [
                        'class' => 'btn btn-sm btn-outline-primary',
                        'icon' => '<i class="fas fa-pencil-alt"></i>'
                    ],
                    'deleteOptions' => [
                        'class' => 'btn btn-sm btn-outline-danger',
                        'icon' => '<i class="fas fa-times"></i>'
                    ]
                ]
            ]),
        ]); ?>

    </div>
</div>
