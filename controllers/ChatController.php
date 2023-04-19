<?php

namespace uzdevid\dashboard\controllers;

use uzdevid\dashboard\chat\models\service\ChatService;
use uzdevid\dashboard\chat\widgets\Chat\Chat;
use uzdevid\dashboard\components\BaseController;
use Yii;
use yii\base\InvalidConfigException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

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
        if (!class_exists(Chat::class)) {
            throw new InvalidConfigException(Yii::t('system.error', 'Extension "{name}" not found', ['name' => 'uzdevid/dashboard-chat']));
        }
        parent::init();
    }

    public function actionRoom(int $id) {
        return json_decode(Chat::widget(['id' => $id]), true);
    }

    public function actionRoomIfExist(int $companion_id): Response|array {
        if ($companion_id == Yii::$app->user->id) {
            throw new BadRequestHttpException(Yii::t('system.error', 'You can not create chat with yourself'));
        }

        try {
            $chat_id = ChatService::getChatId($companion_id, Yii::$app->user->id);
        } catch (NotFoundHttpException $e) {
            return json_decode(Chat::widget(['companionId' => $companion_id]), true);
        }

        return $this->actionRoom($chat_id);
    }
}
