<?php

namespace uzdevid\dashboard\models;

use yii\web\IdentityInterface;

class Identity extends User implements IdentityInterface {
    public static function findIdentity($id): User|IdentityInterface|null {
        return static::findOne($id);
    }

    /**
     * @param $token
     * @param $type
     *
     * @return User|IdentityInterface|null
     */
    public static function findIdentityByAccessToken($token, $type = null): User|IdentityInterface|null {
        return @Device::findOne(['access_token' => $token])->user;
    }

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @return null
     */
    public function getAuthKey() {
        return null;
    }

    /**
     * @param $authKey
     *
     * @return bool|null
     */
    public function validateAuthKey($authKey): ?bool {
        return Device::find()->where(['access_token' => $authKey, 'user_id' => $this->id])->exists();
    }

    /**
     * @param $password
     *
     * @return bool
     */
    public function validatePassword($password): bool {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * @param $email
     *
     * @return User|null
     */
    public static function findByEmail($email): ?User {
        return static::findOne(['email' => $email]);
    }
}