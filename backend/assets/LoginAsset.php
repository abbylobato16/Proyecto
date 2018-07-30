<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'css/site.css',
        'bower_components/font-awesome/css/font-awesome.min.css',
        'dist/css/AdminLTE.min.css',
        'plugins/iCheck/square/blue.css',
        'bower_components/bootstrap/dist/css/bootstrap.min.css',
        'css/logindetails.css',
        'css/site.css',
    ];
    public $js = [
        'plugins/iCheck/icheck.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}