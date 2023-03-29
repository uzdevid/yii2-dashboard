<?php

namespace uzdevid\dashboard\components;

use uzdevid\dashboard\models\Action;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\rest\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\Response;

class BaseRestController extends Controller {
    /**
     * @throws ForbiddenHttpException
     * @throws BadRequestHttpException
     */
    public function beforeAction($action): bool {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
        }

        $access = Action::find()->where(['path' => $action->uniqueId])->one();

        if (is_null($access)) {
            throw new BadRequestHttpException(Yii::t('system.message', 'Action not found in permissions'));
        }

        $actionUsers = ArrayHelper::map($access->users, 'user_id', 'user_id');

        if (!in_array(Yii::$app->user->id, $actionUsers)) {
            throw new ForbiddenHttpException(Yii::t('system.message', 'You are not allowed to perform this action.'));
        }

        return parent::beforeAction($action);
    }
}