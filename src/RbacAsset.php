<?php

namespace antonyz89\rbac;

use yii\web\AssetBundle;

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
    public $js = [
        'js/gii-modal.js',
        'https://use.fontawesome.com/releases/v5.9.0/js/all.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
