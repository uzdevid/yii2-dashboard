<?php

namespace uzdevid\dashboard\modules\system\controllers;

use uzdevid\dashboard\base\filters\DashboardAccessControl;
use uzdevid\dashboard\base\web\Controller;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class DefaultController extends Controller {
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

        $behaviors['dashboard_access'] = [
            'class' => DashboardAccessControl::class,
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
        $this->view->params['breadcrumbs'][] = $this->view->title = Yii::t('system.content', 'System');
        return $this->render('index');
    }
}
