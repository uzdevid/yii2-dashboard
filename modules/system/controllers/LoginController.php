<?php

namespace uzdevid\dashboard\modules\system\controllers;

use uzdevid\dashboard\base\web\Controller;
use uzdevid\dashboard\models\form\LoginForm;
use Yii;
use yii\web\Response;

class LoginController extends Controller {

    public $layout = '@vendor/uzdevid/yii2-dashboard/views/layouts/simple';

    /**
     * @return string
     */
    public function actionIndex(): string {
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $this->goBack();
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
