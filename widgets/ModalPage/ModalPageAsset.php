<?php

namespace uzdevid\dashboard\widgets\ModalPage;

use yii\web\AssetBundle;

class ModalPageAsset extends AssetBundle {
    public $sourcePath = '@vendor/uzdevid/yii2-dashboard/widgets/ModalPage/assets';
    public $css = [];
    public $js = [
        'js/script.js',
    ];
    public $depends = [
        'yii\bootstrap5\BootstrapAsset'
    ];
}