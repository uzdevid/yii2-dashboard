<?php

namespace uzdevid\dashboard\widgets\Toaster;

use yii\base\Widget;

class Toaster extends Widget {
    const DEFAULT_SUCCESS_SCRIPT = 'toaster.success(data.body.message, data.body.title)';
    const DEFAULT_ERROR_SCRIPT = 'toaster.error(data.body.message, data.body.title)';
    const DEFAULT_OPTIONS = [
        "closeButton" => true,
        "newestOnTop" => true,
        "progressBar" => true,
        "showDuration" => "300",
        "hideDuration" => "1000",
        "timeOut" => "5000",
        "extendedTimeOut" => "1000",
        "showEasing" => "swing",
        "hideEasing" => "linear",
        "showMethod" => "fadeIn",
        "hideMethod" => "fadeOut"
    ];

    /**
     * @return array
     */
    public static function success(): array {
        return [
            'script' => self::DEFAULT_SUCCESS_SCRIPT,
            'options' => self::DEFAULT_OPTIONS
        ];
    }

    /**
     * @return array
     */
    public static function error(): array {
        return [
            'script' => self::DEFAULT_ERROR_SCRIPT,
            'options' => self::DEFAULT_OPTIONS
        ];
    }
}