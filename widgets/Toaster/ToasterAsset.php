<?php

namespace uzdevid\dashboard\widgets\Toaster;

use yii\web\AssetBundle;

class ToasterAsset extends AssetBundle {
    public $sourcePath = '@vendor/uzdevid/yii2-dashboard/widgets/Toaster/assets';
    public $css = [
        'css/toaster.min.css',
    ];
    public $js = [
        'js/toaster.min.js',
    ];
    public $depends = [
        'yii\bootstrap5\BootstrapAsset'
    ];
}