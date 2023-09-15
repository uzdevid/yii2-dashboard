<?php

namespace uzdevid\dashboard\modules\system\controllers;

use uzdevid\dashboard\access\control\filters\DashboardAccessControl;
use uzdevid\dashboard\access\control\models\service\ActionService;
use uzdevid\dashboard\base\helpers\Url;
use uzdevid\dashboard\base\web\Controller;
use uzdevid\dashboard\models\search\UserSearch;
use uzdevid\dashboard\models\User;
use uzdevid\dashboard\widgets\ModalPage\ModalPage;
use uzdevid\dashboard\widgets\ModalPage\ModalPageOptions;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class UserController extends Controller {
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
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', compact('dataProvider', 'searchModel'));
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
                'title' => ModalPage::title($model->fullName, '<i class="bi bi-person"></i>'),
                'view' => $this->renderAjax('modal/view', compact('model'))
            ]
        ]);
    }

    public function actionCreate(): Response|string {
        $model = new User();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(Url::to(['index']));
            }
        } else {
            $model->loadDefaultValues();
        }

        if (!$this->request->isAjax) {
            return $this->render('create', compact('model'));
        }

        return $this->asJson([
            'success' => true,
            'modal' => ModalPage::options(true, ModalPageOptions::SIZE_XL),
            'body' => [
                'title' => ModalPage::title(Yii::t('system.content', 'Create User'), '<i class="bi bi-person"></i>'),
                'view' => $this->renderAjax('modal/create', compact('model'))
            ]
        ]);
    }

    public function actionDelete(int $id): Response {
        $model = $this->findModel($id);
        $model->delete();
        return $this->redirect(Url::to(['index']));
    }

    /**
     * @param int $id ID
     *
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id): User {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('system.message', 'The requested page does not exist.'));
    }

    public function actionOnlineUsers() {
        $online_users = User::find()->where(['>', 'last_activity_time', time() - 60 * 2])->orderBy(['last_activity_time' => SORT_DESC])->all();
        $users = User::find()->where(['not in', 'id', ArrayHelper::map($online_users, 'id', 'id')])->orderBy(['last_activity_time' => SORT_DESC])->all();

        return $this->asJson([
            'success' => true,
            'body' => [
                'badge' => count($online_users),
                'view' => $this->renderAjax('ajax/online-users', compact('online_users', 'users'))
            ]
        ]);
    }
}
