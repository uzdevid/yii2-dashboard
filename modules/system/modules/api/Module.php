<?php

namespace uzdevid\dashboard\modules\system\modules\api;

use uzdevid\dashboard\events\ModuleEvent;
use Yii;

class Module extends \yii\base\Module {
    /**
     * {@inheritdoc}
     */
    public $components = [
        'request' => [
            'class' => yii\web\Request::class,
            'enableCookieValidation' => false,
            'parsers' => [
                'application/json' => yii\web\JsonParser::class,
            ]
        ]
    ];

    public const EVENT_BEFORE_INIT = 'beforeInit';
    public const EVENT_AFTER_INIT = 'afterInit';

    /**
     * {@inheritdoc}
     */
    public function init() {
        Yii::$app->trigger(self::EVENT_BEFORE_INIT, new ModuleEvent($this));

        parent::init();

        Yii::$app->trigger(self::EVENT_AFTER_INIT, new ModuleEvent($this));
    }
}
