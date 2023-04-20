<?php

namespace uzdevid\dashboard\overrides;

class Url extends \yii\helpers\Url {
    public static function to($url = '', $scheme = false): string {
        if (is_array($url) && isset($_GET['menu'])) {
            $url = array_merge($url, ['menu' => $_GET['menu']]);
        }
        return parent::to($url, $scheme);
    }
}