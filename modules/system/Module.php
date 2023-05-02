<?php

namespace uzdevid\dashboard\modules\system;

use uzdevid\dashboard\access\control\controllers\ActionController;
use uzdevid\dashboard\modify\log\controllers\ModifyLogController;
use Yii;
use yii\web\Response;

/**
 * system module definition class
 */
class Module extends \yii\base\Module {
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

        $this->controllerMap['action'] = ActionController::class;
        $this->controllerMap['modify-log'] = ModifyLogController::class;
    }
}
