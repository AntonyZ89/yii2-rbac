<?php

use antonyz89\rbac\RbacAsset;
use antonyz89\rbac\widgets\Alert;
use yii\bootstrap4\Modal;
use yii\bootstrap4\NavBar;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $content string */

RbacAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="none">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?= Modal::widget(['id' => 'modal']) ?>
    <?= Modal::widget(['id' => 'modal-lg', 'size' => Modal::SIZE_LARGE]) ?>
    <div class="page-container">
        <?php $this->beginBody() ?>
        <?php NavBar::begin([
            'brandLabel' => 'RBAC Manager',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-dark bg-dark',
            ],
        ]);

        /*Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => 'Home', 'url' => ['/site/index']],
                ['label' => 'About', 'url' => ['/site/about']],
                ['label' => 'Contact', 'url' => ['/site/contact']],
            ],
        ]);*/
        NavBar::end();
        ?>

        <div class="container content-container">
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
        <div class="footer-fix"></div>
    </div>
    <footer class="footer border-top">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <p>By <a href="http://github.com/AntonyZ89/">AntonyZ89</a></p>
                </div>
                <div class="col-6">
                    <p class="text-right"><?= Yii::powered() ?></p>
                </div>
            </div>
        </div>
    </footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
