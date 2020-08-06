<?php

use antonyz89\rbac\RbacAsset;
use yii\helpers\Html;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Nav;
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
    <?= \yii\bootstrap4\Modal::widget(['id' => 'modal']) ?>
    <div class="page-container">
        <?php $this->beginBody() ?>
        <?php NavBar::begin([
            'brandLabel' => 'RBAC Manager',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-dark bg-dark',
            ],
        ]);

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => 'Home', 'url' => ['/site/index']],
                ['label' => 'About', 'url' => ['/site/about']],
                ['label' => 'Contact', 'url' => ['/site/contact']],
            ],
        ]);
        NavBar::end();
        ?>

        <div class="container content-container">
            <?= $content ?>
        </div>
        <div class="footer-fix"></div>
    </div>
    <footer class="footer border-top">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <p>A Product of <a href="http://www.yiisoft.com/">Yii Software LLC</a></p>
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
