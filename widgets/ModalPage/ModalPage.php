<?php

namespace uzdevid\dashboard\widgets\ModalPage;

use yii\base\Widget;
use yii\bootstrap5\Html;
use yii\helpers\Url;

class ModalPage extends Widget {
    /**
     * @return string
     */
    public function run(): string {
        return $this->render('index');
    }

    /**
     * @param $text
     * @param $url
     * @param $options
     * @return string
     */
    public static function link($text, $url, $options = []): string {
        if (empty($options['class'])) {
            $options['class'] = 'in-modal';
        } else {
            $options['class'] .= ' in-modal';
        }

        return Html::a($text, Url::to($url), $options);
    }

    /**
     * @param bool $centered
     * @param string $size
     * @return array
     */
    public static function options(bool $centered = true, string $size = ''): array {
        return [
            'centered' => $centered,
            'size' => $size,
        ];
    }

    /**
     * @param string $text
     * @param string|null $icon
     * @return string
     */
    public static function title(string $text, string|null $icon = null): string {
        return "{$icon} {$text}";
    }
}