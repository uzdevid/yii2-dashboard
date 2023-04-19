<?php

namespace uzdevid\dashboard\modules\system\controllers;

use uzdevid\dashboard\models\service\UserService;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;

class ProfileController extends Controller {
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

        return $behaviors;
    }

    public function actionIndex(): Response|string {
        $this->view->title = Yii::t('system.content', 'Profile');
        $this->view->params['breadcrumbs'][] = $this->view->title;

        $user = Yii::$app->user->identity;

        if (!$this->request->isPost) {
            return $this->render('index', compact(['user']));
        }

        $image = UserService::uploadImage($user, UploadedFile::getInstance($user, 'image'));

        $user->load($this->request->post());

        if ($user->new_password != null) {
            $user->scenario = 'resetPassword';
            if ($user->validate(['new_password'])) {
                $user->resetPassword();
                if ($user->save()) {
                    Yii::$app->session->setFlash('success', Yii::t('system.message', 'Password changed successfully'));
                    return $this->refresh();
                }
            }
        }

        $user->image = $image;

        if ($user->save()) {
            Yii::$app->session->setFlash('success', Yii::t('system.message', 'Profile updated successfully'));
            return $this->refresh();
        }

        return $this->render('index', compact(['user']));
    }
}
