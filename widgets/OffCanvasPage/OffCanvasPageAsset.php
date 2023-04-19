<?php

namespace uzdevid\dashboard\widgets\OffCanvasPage;

use yii\web\AssetBundle;

class OffCanvasPageAsset extends AssetBundle {
    public $sourcePath = '@vendor/uzdevid/yii2-dashboard/widgets/OffCanvasPage/assets';
    public $css = [];
    public $js = [
        'js/script.js',
    ];
    public $depends = [
        'yii\bootstrap5\BootstrapAsset'
    ];
}