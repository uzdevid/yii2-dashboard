<?php

namespace uzdevid\dashboard\controllers;

use uzdevid\dashboard\chat\widgets\ChatRoom\ChatRoom;
use uzdevid\dashboard\components\BaseController;
use Yii;
use yii\base\InvalidConfigException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class ChatController extends BaseController {
    public function behaviors(): array {
        $behaviors = parent::behaviors();
        $behaviors['access'] = [
            'class' => AccessControl::class,
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ],
        ];

        $behaviors['verbs'] = [
            'class' => VerbFilter::class,
            'actions' => [
                'room' => ['GET'],
            ],
        ];

        return $behaviors;
    }

    public function init() {
        if (!class_exists(ChatRoom::class)) {
            throw new InvalidConfigException(Yii::t('system.error', 'Extension "{name}" not found', ['name' => 'uzdevid/dashboard-chat']));
        }
        parent::init();
    }

    public function actionRoom($id) {
        return ChatRoom::widget(['id' => $id]);
    }
}
