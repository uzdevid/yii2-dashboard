<?php

namespace uzdevid\dashboard\modules\system\controllers;

use uzdevid\dashboard\access\control\filters\DashboardAccessControl;
use uzdevid\dashboard\base\helpers\Url;
use uzdevid\dashboard\base\web\Controller;
use uzdevid\dashboard\models\Menu;
use uzdevid\dashboard\models\search\MenuSearch;
use uzdevid\dashboard\widgets\ModalPage\ModalPage;
use uzdevid\dashboard\widgets\ModalPage\ModalPageOptions;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * MenuController implements the CRUD actions for Menu model.
 */
class MenuController extends Controller {
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
        $searchModel = new MenuSearch();
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
        if (!$this->request->isAjax) {
            return $this->render('view', ['model' => $this->findModel($id)]);
        }

        return $this->asJson([
            'success' => true,
            'modal' => ModalPage::options(true, ModalPageOptions::SIZE_LG),
            'body' => [
                'title' => ModalPage::title(Yii::t('system.content', 'Menu data'), '<i class="bi bi-menu-up"></i>'),
                'view' => $this->renderAjax('modal/view', ['model' => $this->findModel($id)])
            ]
        ]);
    }

    /**
     * @return Response|string
     */
    public function actionCreate(): Response|string {
        $model = new Menu();

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
            'modal' => ModalPage::options(true, ModalPageOptions::SIZE_LG),
            'body' => [
                'title' => ModalPage::title(Yii::t('system.content', 'Create Menu'), '<i class="bi bi-menu-up"></i>'),
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
            return $this->redirect(Url::to(['index']));
        }

        if (!$this->request->isAjax) {
            return $this->render('update', compact('model'));
        }

        return $this->asJson([
            'success' => true,
            'modal' => ModalPage::options(true, ModalPageOptions::SIZE_LG),
            'body' => [
                'title' => ModalPage::title(Yii::t('system.content', 'Update Menu data'), '<i class="bi bi-menu-up"></i>'),
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
     * @return Menu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id): Menu {
        if (($model = Menu::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('system.message', 'The requested page does not exist.'));
    }
}
