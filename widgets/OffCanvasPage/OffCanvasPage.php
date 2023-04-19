<?php

namespace uzdevid\dashboard\widgets\OffCanvasPage;

use yii\base\Widget;
use yii\bootstrap5\Html;
use yii\helpers\Url;

class OffCanvasPage extends Widget {
    /**
     * @return string|void
     */
    public function run() {
        return $this->render('index');
    }

    /**
     * @param string $text
     * @param string|array $url
     * @param array $options
     * @return string
     */
    public static function link(string $text, string|array $url, array $options = []): string {
        if (empty($options['class'])) {
            $options['class'] = 'in-offcanvas';
        } else {
            $options['class'] .= ' in-offcanvas';
        }
        return Html::a($text, Url::to($url), $options);
    }

    /**
     * @param string $side
     * @return string[]
     */
    public static function options(string $side): array {
        return [
            'side' => $side,
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