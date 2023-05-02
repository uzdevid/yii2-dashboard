<?php

namespace uzdevid\dashboard\modules\system\modules\api;

use Yii;
use yii\web\Response;

/**
 * api module definition class
 */
class Module extends \yii\base\Module {
    /**
     * {@inheritdoc}
     */
    public $components = [
        'request' => [
            'class' => 'yii\web\Request',
            'enableCookieValidation' => false,
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
                'application/xml' => 'yii\web\XmlParser'
            ]
        ],
        'response' => [
            'class' => 'yii\web\Response',
            'formatters' => [
                'json' => [
                    'class' => 'yii\web\JsonResponseFormatter',
                    'prettyPrint' => YII_DEBUG,
                    'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
                ],
            ],
        ],
    ];

    /**
     * {@inheritdoc}
     */
    public function init() {
        parent::init();

        Yii::$app->response->format = Response::FORMAT_JSON;
    }
}
