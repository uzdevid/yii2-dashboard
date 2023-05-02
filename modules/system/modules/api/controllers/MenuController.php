<?php

namespace uzdevid\dashboard\modules\system\modules\api\controllers;

use uzdevid\dashboard\access\control\filters\DashboardAccessControl;
use uzdevid\dashboard\base\rest\Controller;
use uzdevid\dashboard\models\Menu;
use uzdevid\dashboard\models\service\MenuService;
use uzdevid\dashboard\widgets\Toaster\Toaster;
use Yii;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class MenuController extends Controller {
    public function behaviors(): array {
        $behaviors = parent::behaviors();
        $behaviors['verb'] = [
            'class' => VerbFilter::class,
            'actions' => [
                'index' => ['GET'],
                'sort-completed' => ['POST'],
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
     * @return array
     */
    public function actionIndex(): array {
        $models = Menu::find()->where(['parent_id' => null])->orderBy(['order' => SORT_ASC])->all();

        $menus = [];
        foreach ($models as $model) {
            $menus = array_merge($menus, MenuService::list($model));
        }

        return [
            'success' => true,
            'body' => [
                'menu' => $menus
            ]
        ];
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionSortCompleted(): array {
        $raw = json_decode(Yii::$app->request->rawBody, true);

        foreach ($raw['menus'] as $menu) {
            $model = Menu::findOne($menu['id']);

            if (is_null($model)) {
                throw new NotFoundHttpException(Yii::t('system.message', 'Menu not found'));
            }

            if ($menu['level'] == 1) {
                $model->parent_id = null;
            } else {
                $model->parent_id = $menu['parent_id'];
            }

            $model->order = (int)$menu['order'];

            if (!$model->save()) {
                return [
                    'success' => false,
                    'toaster' => Toaster::error(),
                    'body' => [
                        'title' => Yii::t('system.message', 'Error'),
                        'message' => Yii::t('system.message', 'Menu failed to update'),
                        'errors' => $model->errors
                    ]
                ];
            }
        }

        return [
            'success' => true,
            'toaster' => Toaster::success(),
            'body' => [
                'title' => Yii::t('system.message', 'Success'),
                'message' => Yii::t('system.message', 'Menu successfully updated')
            ]
        ];
    }
}
