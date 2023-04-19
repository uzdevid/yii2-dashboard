<?php

namespace uzdevid\dashboard\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class DashboardAsset extends AssetBundle {
    public $sourcePath = '@vendor/uzdevid/yii2-dashboard/assets';
    public $css = [
        'libraries/bootstrap/css/bootstrap.min.css',
        'libraries/bootstrap-icons/bootstrap-icons.css',
        'libraries/boxicons/css/boxicons.min.css',
        'libraries/quill/quill.snow.css',
        'libraries/quill/quill.bubble.css',
        'libraries/remixicon/remixicon.css',
        'libraries/simple-datatables/style.css',
        'libraries/jquery-ui/css/style.css',
        'libraries/sortable-list/css/treeSortable.css',
        'libraries/choices/css/choices.min.css',
        'css/dashboard.css',
        'css/main.css',
    ];
    public $js = [
        [
            'js/jquery.js',
            'position' => View::POS_HEAD
        ],
        'libraries/bootstrap/js/bootstrap.bundle.min.js',
        'libraries/apexcharts/apexcharts.min.js',
        'libraries/chart.js/chart.min.js',
        'libraries/echarts/echarts.min.js',
        'libraries/quill/quill.min.js',
        'libraries/simple-datatables/simple-datatables.js',
        'libraries/tinymce/tinymce.min.js',
        'libraries/sortable-list/js/treeSortable.js',
        'libraries/jquery-ui/js/script.js',
        'js/popper.min.js',
        'js/tippy-bundle.umd.js',
        'js/notifications-badge.js',
        [
            'libraries/choices/js/choices.min.js',
            'position' => View::POS_HEAD
        ],
        'js/dashboard.js',
        //
        'js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset'
    ];
}
