<?php

namespace uzdevid\dashboard\modules\system\controllers;

use uzdevid\dashboard\access\control\filters\DashboardAccessControl;
use uzdevid\dashboard\base\helpers\Url;
use uzdevid\dashboard\base\web\Controller;
use uzdevid\dashboard\models\Message;
use uzdevid\dashboard\models\search\MessageSearch;
use uzdevid\dashboard\models\search\YiiMessageSearch as YiiMessageSearch;
use uzdevid\dashboard\models\YiiMessage;
use uzdevid\dashboard\widgets\ModalPage\ModalPage;
use uzdevid\dashboard\widgets\ModalPage\ModalPageOptions;
use uzdevid\dashboard\widgets\Toaster\Toaster;
use Yii;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class YiiMessageController extends Controller {
    /**
     * @inheritDoc
     */
    public function behaviors(): array {
        $behaviors = parent::behaviors();

        $behaviors['VerbFilter'] = [
            'class' => VerbFilter::class,
            'actions' => [
                'index' => ['GET'],
                'create' => ['GET', 'POST'],
                'update' => ['GET', 'POST'],
                'view' => ['GET'],
                'delete' => ['POST'],
            ],
        ];

        return $behaviors;
    }

    /**
     * @return string
     */
    public function actionIndex(): string {
        $searchModel = new MessageSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

    /**
     * @param int $id ID
     *
     * @return Response|string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView(int $id): Response|string {
        $model = $this->findModel($id);

        if (!$this->request->isAjax) {
            return $this->render('view', compact('model'));
        }

        return $this->asJson([
            'success' => true,
            'modal' => ModalPage::options(true, ModalPageOptions::SIZE_LG),
            'body' => [
                'title' => ModalPage::title(Yii::t('system.content', 'Yii Source Message'), '<i class="bi bi-translate"></i>'),
                'view' => $this->renderAjax('modal/view', compact('model'))
            ]
        ]);
    }

    /**
     * @param null $source_message_id
     *
     * @return Response|string
     */
    public function actionCreate($source_message_id = null): Response|string {
        $model = new Message();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(Url::to(['/system/yii-message/index']));
            }
        } else {
            $model->loadDefaultValues();
        }

        $title = Yii::t('system.content', 'Create Yii Source Message');

        if ($source_message_id != null) {
            $model->id = $source_message_id;
            $title = Yii::t('system.content', 'Create Yii Source Message for {message}', ['message' => $model->sourceMessage->message]);
        }

        if (!$this->request->isAjax) {
            return $this->render('create', compact('model'));
        }

        return $this->asJson([
            'success' => true,
            'modal' => ModalPage::options(true, ModalPageOptions::SIZE_LG),
            'toaster' => Toaster::success(),
            'body' => [
                'title' => ModalPage::title($title, '<i class="bi bi-translate"></i>'),
                'view' => $this->renderAjax('modal/create', compact('model'))
            ]
        ]);
    }

    /**
     * @param int $id ID
     *
     * @return Response|string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate(int $id): Response|string {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(Url::to(['/system/yii-message/index']));
        }

        if (!$this->request->isAjax) {
            return $this->render('update', compact('model'));
        }

        return $this->asJson([
            'success' => true,
            'modal' => ModalPage::options(true, ModalPageOptions::SIZE_LG),
            'body' => [
                'title' => ModalPage::title(Yii::t('system.content', 'Update Yii Source Message'), '<i class="bi bi-translate"></i>'),
                'view' => $this->renderAjax('modal/update', compact('model'))
            ]
        ]);
    }

    /**
     * @param int $id ID
     *
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete(int $id): Response {
        $this->findModel($id)->delete();

        return $this->redirect(Url::to(['index']));
    }

    /**
     * @param int $id ID
     *
     * @return YiiMessage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id): YiiMessage {
        if (($model = Message::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('system.message', 'The requested page does not exist.'));
    }
}
