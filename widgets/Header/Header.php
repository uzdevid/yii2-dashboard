<?php

namespace uzdevid\dashboard\widgets\Header;

use uzdevid\dashboard\models\Notification;
use Yii;
use yii\base\Widget;

class Header extends Widget {
    /**
     * @return string|void
     */
    public function run(): string {
        $user = Yii::$app->user->identity;
        $unread_notifications = Notification::find()->where(['user_id' => $user->id])->andWhere(['is_read' => 0])->all();

        return $this->render('index', compact('user', 'unread_notifications'));
    }
}