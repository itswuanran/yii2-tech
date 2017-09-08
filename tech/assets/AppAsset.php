<?php

namespace tech\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Main tech application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        '/js/bootstrap.min.js',
        '/js/plugins/metisMenu/jquery.metisMenu.js',
        '/js/plugins/slimscroll/jquery.slimscroll.min.js',
        '/js/inspinia.js',
        '/js/plugins/pace/pace.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
    public $jsOptions = [
        'position' => View::POS_HEAD,
    ];
}
