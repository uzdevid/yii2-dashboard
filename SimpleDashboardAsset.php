<?php

namespace uzdevid\dashboard;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class SimpleDashboardAsset extends AssetBundle {
    public $sourcePath = '@vendor/uzdevid/yii2-dashboard/assets';
    public $css = [
        'libraries/bootstrap/css/bootstrap.min.css',
        'libraries/bootstrap-icons/bootstrap-icons.css',
        'css/dashboard.css',
        'css/main.css',
    ];
    public $js = [
        'libraries/bootstrap/js/bootstrap.bundle.min.js',
        'libraries/tinymce/tinymce.min.js',
        'js/dashboard.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];
}