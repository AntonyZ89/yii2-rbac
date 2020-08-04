<?php

namespace antonyz89\rbac;

use yii\bootstrap\BootstrapAsset;
use yii\bootstrap\BootstrapPluginAsset;
use yii\bootstrap\BootstrapThemeAsset;
use yii\web\AssetBundle;
use yii\widgets\Menu;

/**
 * This declares the asset files required by Rbac V2 .
 *
 * @author Antony Gabriel <antonyz.dev@gmail.com>
 * @since 1.0
 */
class RbacAsset extends AssetBundle
{
    public $sourcePath = '@antonyz89/rbac/assets';
    public $css = [
        'css/main.css',
    ];
    public $js = [];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
