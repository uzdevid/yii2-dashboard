<?php

namespace uzdevid\dashboard;

use yii\web\AssetBundle;

class SimpleDashboardAsset extends AssetBundle {
    public $sourcePath = '@npm/dashboard-assets';
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
        \yii\web\YiiAsset::class,
        \yii\bootstrap5\BootstrapAsset::class,
    ];
}