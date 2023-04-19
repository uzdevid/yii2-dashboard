<?php

namespace uzdevid\dashboard\modules\system\controllers;

use uzdevid\dashboard\components\BaseController;
use uzdevid\dashboard\widgets\ModalPage\ModalPage;
use uzdevid\dashboard\widgets\ModalPage\ModalPageOptions;
use uzdevid\dashboard\widgets\Toaster\Toaster;
use uzdevid\dashboard\components\Url;
use uzdevid\dashboard\models\search\YiiMessageSearch as YiiMessageSearch;
use uzdevid\dashboard\models\YiiMessage;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class YiiMessageController extends BaseController {
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
     * @return string
     */
    public function actionIndex(): string {
        $searchModel = new YiiMessageSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

    /**
     * @param int $id ID
     * @return array|string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView(int $id): array|string {
        $model = $this->findModel($id);

        if ($this->request->isAjax) {
            $modal = ModalPage::options(true, ModalPageOptions::SIZE_LG);
            $view = $this->renderAjax('modal/view', compact('model'));

            return [
                'success' => true,
                'modal' => $modal,
                'body' => [
                    'title' => ModalPage::title(Yii::t('system.content', 'Yii Source Message'), '<i class="bi bi-translate"></i>'),
                    'view' => $view
                ]
            ];
        }

        return $this->render('view', compact('model'));
    }

    /**
     * @param null $source_message_id
     * @return Response|array|string
     */
    public function actionCreate($source_message_id = null): Response|array|string {
        $model = new YiiMessage();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(Url::to(['/system/yii-source-message/index']));
            }
        } else {
            $model->loadDefaultValues();
        }

        $title = Yii::t('system.content', 'Create Yii Source Message');

        if ($source_message_id != null) {
            $model->id = $source_message_id;
            $title = Yii::t('system.content', 'Create Yii Source Message for {message}', ['message' => $model->sourceMessage->message]);
        }

        if ($this->request->isAjax) {
            $modal = ModalPage::options(true, ModalPageOptions::SIZE_LG);
            $view = $this->renderAjax('modal/create', compact('model'));

            return [
                'success' => true,
                'modal' => $modal,
                'toaster' => Toaster::success(),
                'body' => [
                    'title' => ModalPage::title($title, '<i class="bi bi-translate"></i>'),
                    'view' => $view
                ]
            ];
        }

        return $this->render('create', compact('model'));
    }

    /**
     * @param int $id ID
     * @return Response|array|string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate(int $id): Response|array|string {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(Url::to(['/system/yii-source-message/index']));
        }

        if ($this->request->isAjax) {
            $modal = ModalPage::options(true, ModalPageOptions::SIZE_LG);
            $view = $this->renderAjax('modal/update', compact('model'));

            return [
                'success' => true,
                'modal' => $modal,
                'body' => [
                    'title' => ModalPage::title(Yii::t('system.content', 'Update Yii Source Message'), '<i class="bi bi-translate"></i>'),
                    'view' => $view
                ]
            ];
        }

        return $this->render('update', compact('model'));
    }

    /**
     * @param int $id ID
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete(int $id): Response {
        $this->findModel($id)->delete();

        return $this->redirect(Url::to(['index']));
    }

    /**
     * @param int $id ID
     * @return YiiMessage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id): YiiMessage {
        if (($model = YiiMessage::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('system.message', 'The requested page does not exist.'));
    }
}
