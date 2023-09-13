<?php

namespace uzdevid\dashboard\modules\system\controllers;

use uzdevid\dashboard\base\web\Controller;
use uzdevid\dashboard\models\form\LoginForm;
use Yii;
use yii\web\Response;

class LoginController extends Controller {
    public $layout = '@vendor/uzdevid/yii2-dashboard/views/layouts/simple';

    public function behaviors() {
        $behaviors = parent::behaviors();

        unset($behaviors['access'], $behaviors['AccessControl']);

        return $behaviors;
    }

    /**
     * @return string
     */
    public function actionIndex(): Response|string {
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if (is_null(Yii::$app->request->referrer)) {
                return $this->redirect(Yii::$app->homeUrl);
            }
            
            return $this->redirect(str_ends_with(Yii::$app->request->referrer, Yii::$app->request->url) ? Yii::$app->homeUrl : Yii::$app->request->referrer);
        }

        $this->view->title = Yii::t('system.content', 'Login');

        $this->view->params['layouts']['fields'] = [
            'email' => $this->renderPartial('fields/email.php'),
            'password' => $this->renderPartial('fields/password.php'),
            'rememberMe' => $this->renderPartial('fields/rememberMe.php'),
        ];

        return $this->render('index', ['model' => $model]);
    }

    /**
     * @return Response
     */
    public function actionOut(): Response {
        Yii::$app->user->logout();
        return $this->goHome();
    }

}
