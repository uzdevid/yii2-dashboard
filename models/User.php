<?php

namespace uzdevid\dashboard\models;

use uzdevid\dashboard\models\service\UserService;
use Yii;
use yii\behaviors\BlameableBehavior;

class User extends base\User {
    public function getFullname(): string {
        return $this->surname . ' ' . $this->name;
    }

    public function getProfileImage(): string {
        return $this->image ? Yii::$app->params['profileImageBaseUrl'] . $this->image : Yii::$app->params['profileImageBaseUrl'] . 'default.png';
    }

    public static function languageChanged($event): void {
        $user = Yii::$app->user;
        if (!$user->isGuest) {
            $user->identity->language = $event->language;
            $user->identity->save(false);
        }
    }

    public function beforeSave($insert): bool {
        if ($insert) {
            $password = rand(100000, 999999);
            UserService::sendLoginDetails($this->email, $password);
            $this->password = Yii::$app->getSecurity()->generatePasswordHash($password);
        }

        return parent::beforeSave($insert);
    }

    public function behaviors(): array {
        $behaviors = parent::behaviors();

        $behaviors['BlameableBehavior'] = [
            'class' => BlameableBehavior::class,
            'attributes' => [
                self::EVENT_BEFORE_INSERT => ['user_id'],
            ]
        ];

        return $behaviors;
    }
}
