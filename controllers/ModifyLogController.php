<?php

namespace uzdevid\dashboard\controllers;

use Mistralys\Diff\Diff;
use uzdevid\dashboard\components\BaseController;
use uzdevid\dashboard\widgets\ModalPage\ModalPage;
use uzdevid\dashboard\widgets\ModalPage\ModalPageOptions;
use uzdevid\dashboard\models\ModifyLog;
use uzdevid\dashboard\models\search\ModifyLogSearch;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class ModifyLogController extends BaseController {
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
        $searchModel = new ModifyLogSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $dataProvider->sort->defaultOrder = [
            'id' => SORT_DESC,
            'modify_time' => SORT_DESC
        ];

        return $this->render('index', compact('dataProvider', 'searchModel'));
    }

    public function actionDiff($id) {
        $model = ModifyLog::findOne($id);

        if ($model == null) {
            throw new NotFoundHttpException(\Yii::t('system.message', 'The requested page does not exist.'));
        }

        $diff = Diff::compareStrings((string)$model->old_value, (string)$model->value);

        if ($this->request->isAjax) {
            $modal = ModalPage::options(true, ModalPageOptions::SIZE_XL);
            $view = $this->renderAjax('modal/diff', compact('model', 'diff'));

            return [
                'success' => true,
                'modal' => $modal,
                'body' => [
                    'title' => ModalPage::title($model->model, '<i class="bi bi-person"></i>'),
                    'view' => $view
                ]
            ];
        }

        return $this->render('diff', compact('model', 'diff'));
    }
}
