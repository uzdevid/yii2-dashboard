<?php

namespace uzdevid\dashboard\bootstraps;

use Yii;
use yii\base\BootstrapInterface;
use yii\web\Application;

class UserActivityBootstrap implements BootstrapInterface {

    public function bootstrap($app) {
        $app->on(Application::EVENT_BEFORE_REQUEST, function () use ($app) {
            if (!Yii::$app->user->isGuest) {
                Yii::$app->user->identity->updateAttributes(['last_activity_time' => time()]);
            }
        });
    }

}