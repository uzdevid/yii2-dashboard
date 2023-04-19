<?php

namespace uzdevid\dashboard\modules\system\controllers;

use uzdevid\dashboard\components\BaseController;
use uzdevid\dashboard\widgets\ModalPage\ModalPage;
use uzdevid\dashboard\widgets\ModalPage\ModalPageOptions;
use uzdevid\dashboard\widgets\Toaster\Toaster;
use uzdevid\dashboard\components\Url;
use uzdevid\dashboard\models\NotificationTypeRole;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class NotificationTypeRoleController extends BaseController {
    /**
     * @inheritDoc
     */
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
                'delete' => ['POST'],
            ],
        ];

        return $behaviors;
    }

    /**
     * @param int|null $id
     * @return Response|array|string
     */
    public function actionCreate(int $id = null): Response|array|string {
        $model = new NotificationTypeRole();

        if ($id) {
            $model->notification_type_id = $id;
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(Url::to(['/system/notification-type/index']));
            }
        } else {
            $model->loadDefaultValues();
        }

        if ($this->request->isAjax) {
            $modal = ModalPage::options(true, ModalPageOptions::SIZE_LG);
            $view = $this->renderAjax('modal/create', ['model' => $model]);

            return [
                'success' => true,
                'modal' => $modal,
                'toaster' => Toaster::success(),
                'body' => [
                    'title' => ModalPage::title(Yii::t('system.content', 'Create Notification Type Role'), '<i class="bi bi-bell"></i>'),
                    'view' => $view
                ]
            ];
        }

        return $this->render('create', compact('model'));
    }

    /**
     * @param int $id ID
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete(int $id): Response {
        $this->findModel($id)->delete();

        return $this->redirect(Url::to(['/system/notification-type/index']));
    }

    /**
     * @param int $id ID
     * @return NotificationTypeRole the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id): NotificationTypeRole {
        if (($model = NotificationTypeRole::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('system.message', 'The requested page does not exist.'));
    }
}
