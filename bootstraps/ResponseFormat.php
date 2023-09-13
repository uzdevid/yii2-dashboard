<?php

namespace uzdevid\dashboard\bootstraps;

use Yii;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\web\Response;

class ResponseFormat implements BootstrapInterface {
    public function bootstrap($app): void {
        $app->on(Application::EVENT_AFTER_ACTION, function ($event) {
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
            }
        });

        $app->response->on(Response::EVENT_BEFORE_SEND, function ($event) {
            $response = $event->sender;

            if ($response->format !== Response::FORMAT_JSON) {
                return;
            }

            $response->format = Response::FORMAT_JSON;

            if (!isset($response->data['success'])) {
                $response->data = [
                    'success' => $response->isSuccessful,
                    'body' => $response->data,
                ];
            }
        });
    }
}