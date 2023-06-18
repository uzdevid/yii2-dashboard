<?php

namespace uzdevid\dashboard\modules\system\modules\api\controllers;

use uzdevid\dashboard\access\control\filters\DashboardAccessControl;
use uzdevid\dashboard\access\control\models\ActionUser;
use uzdevid\dashboard\base\rest\Controller;
use uzdevid\dashboard\widgets\Toaster\Toaster;
use Yii;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

class UserController extends Controller {
    public function behaviors(): array {
        $behaviors = parent::behaviors();
        $behaviors['verb'] = [
            'class' => VerbFilter::class,
            'actions' => [
                'permission' => ['POST'],
            ],
        ];

        if (class_exists(DashboardAccessControl::class)) {
            $behaviors['dashboard_access'] = [
                'class' => DashboardAccessControl::class,
            ];
        }

        return $behaviors;
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionPermission(): array {
        $raw = json_decode(Yii::$app->request->rawBody, true);

        if (!isset($raw['action_id'], $raw['user_id'])) {
            throw new BadRequestHttpException(Yii::t('system.message', 'Missing parameters'));
        }

        $isAllow = ActionUser::find()
            ->where(['action_id' => $raw['action_id'], 'user_id' => $raw['user_id']])
            ->exists();

        if ($isAllow) {
            ActionUser::deleteAll(['action_id' => $raw['action_id'], 'user_id' => $raw['user_id']]);

            return [
                'success' => true,
                'toaster' => Toaster::success(),
                'body' => [
                    'title' => Yii::t('system.message', 'Success'),
                    'message' => Yii::t('system.message', 'Access is denied')
                ]
            ];
        }
        $actionUser = new ActionUser();
        $actionUser->action_id = $raw['action_id'];
        $actionUser->user_id = $raw['user_id'];

        if (!$actionUser->save()) {
            return [
                'success' => false,
                'toaster' => Toaster::error(),
                'body' => [
                    'title' => Yii::t('system.message', 'Error'),
                    'message' => Yii::t('system.message', 'Access is not allowed'),
                    'errors' => $actionUser->errors
                ]
            ];
        }

        return [
            'success' => true,
            'toaster' => Toaster::success(),
            'body' => [
                'title' => Yii::t('system.message', 'Success'),
                'message' => Yii::t('system.message', 'Access is allowed')
            ]
        ];
    }
}
