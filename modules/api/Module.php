<?php

namespace uzdevid\dashboard\modules\api;

use Yii;
use yii\web\Response;

/**
 * api module definition class
 */
class Module extends \yii\base\Module {
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'uzdevid\dashboard\modules\api\controllers';

    /**
     * {@inheritdoc}
     */
    public function init() {
        parent::init();

        Yii::$app->response->format = Response::FORMAT_JSON;
    }
}
