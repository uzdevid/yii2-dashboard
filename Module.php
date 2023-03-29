<?php

namespace uzdevid\dashboard;

use Yii;
use yii\web\Response;

/**
 * system module definition class
 */
class Module extends \yii\base\Module {
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'uzdevid\dashboard\controllers';
    /**
     * {@inheritdoc}
     */
    public function init() {
        parent::init();

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            
            Yii::$app->response->on(Response::EVENT_BEFORE_SEND, function ($event) {
                $response = $event->sender;
                if (!$response->isSuccessful) {
                    $response->data = [
                        'success' => $response->isSuccessful,
                        'body' => $response->data,
                    ];
                }
            });
        }
    }
}
