<?php

namespace uzdevid\dashboard\controllers;

use uzdevid\dashboard\base\web\Controller;
use uzdevid\dashboard\widgets\ModalPage\ModalPage;
use uzdevid\dashboard\widgets\ModalPage\ModalPageOptions;
use uzdevid\dashboard\base\helpers\Url;
use uzdevid\dashboard\models\search\UserSearch;
use uzdevid\dashboard\models\service\ActionService;
use uzdevid\dashboard\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\helpers\ArrayHelper;

class UserController extends Controller {
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
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', compact('dataProvider', 'searchModel'));
    }

    /**
     * @param int $id ID
     * @return Response|string
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
                    'title' => ModalPage::title($model->fullName, '<i class="bi bi-person"></i>'),
                    'view' => $view
                ]
            ];
        }

        return $this->render('view', compact('model'));
    }

    public function actionCreate(): Response|array|string {
        $model = new User();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(Url::to(['index']));
            }
        } else {
            $model->loadDefaultValues();
        }

        if ($this->request->isAjax) {
            $modal = ModalPage::options(true, ModalPageOptions::SIZE_XL);
            $view = $this->renderAjax('modal/create', ['model' => $model]);

            return [
                'success' => true,
                'modal' => $modal,
                'body' => [
                    'title' => ModalPage::title(Yii::t('system.content', 'Create User'), '<i class="bi bi-person"></i>'),
                    'view' => $view
                ]
            ];
        }

        return $this->render('create', compact('model'));
    }

    /**
     * @param int $id
     * @return array|string
     * @throws NotFoundHttpException
     */
    public function actionPermissions(int $id): array|string {
        $model = $this->findModel($id);
        $actions = ActionService::getActions();

        if ($this->request->isAjax) {
            $modal = ModalPage::options(true, ModalPageOptions::SIZE_FULLSCREEN);
            $view = $this->renderAjax('modal/permissions', compact('model', 'actions'));

            return [
                'success' => true,
                'modal' => $modal,
                'body' => [
                    'title' => ModalPage::title($model->fullName, '<i class="bi bi-person"></i>'),
                    'view' => $view
                ]
            ];
        }

        return $this->render('permissions', compact('model', 'actions'));
    }

    public function actionDelete(int $id): Response {
        $model = $this->findModel($id);
        $model->delete();
        return $this->redirect(Url::to(['index']));
    }

    /**
     * @param int $id ID
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id): User {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('system.message', 'The requested page does not exist.'));
    }

    public function actionOnlineUsers(){
        $online_users = User::find()->where(['>', 'last_activity_time', time() - 60 * 2])->orderBy(['last_activity_time' => SORT_DESC])->all();
        $users = User::find()->where(['not in', 'id', ArrayHelper::map($online_users, 'id', 'id')])->orderBy(['last_activity_time' => SORT_DESC])->all();

        return [
            'success' => true,
            'body' => [
                'badge' => count($online_users),
                'view' => $this->renderAjax('ajax/online-users', compact('online_users', 'users'))
            ]
        ];
    }
}
