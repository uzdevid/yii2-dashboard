<?php

namespace uzdevid\dashboard\models\form;

use uzdevid\dashboard\models\Device;
use uzdevid\dashboard\models\User;
use Yii;
use yii\base\Model;
use yii\web\Cookie;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class LoginForm extends Model {
    public string|null $email = null;
    public string|null $password = null;
    public bool $rememberMe = true;
    private User|null $_user = null;

    public function rules(): array {
        return [
            [['email', 'password'], 'required'],
            ['email', 'email'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels(): array {
        return [
            'email' => Yii::t('system.form', 'Email'),
            'password' => Yii::t('system.form', 'Password'),
        ];
    }


    public function validatePassword(string $attribute, array|null $params): void {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, Yii::t('system.message', 'Incorrect email or password'));
            }
        }
    }

    public function getUser(): ?User {
        if ($this->_user === null) {
            $this->_user = User::findOne(['email' => strtolower($this->email)]);
        }
        return $this->_user;
    }

    public function login(): bool {
        if ($this->validate()) {
            $device = Device::find()->where(['user_id' => $this->_user->id, 'name' => $_SERVER['HTTP_USER_AGENT']])->one();

            if (is_null($device)) {
                $device = new Device();
                $device->user_id = $this->_user->id;
                $device->name = $_SERVER['HTTP_USER_AGENT'];
            } else {
                $device->authorization_time = time();
            }

            $device->save();

            $duration = $this->rememberMe ? 3600 * 24 * 30 * 12 * 2 : 0;

            Yii::$app->response->cookies->add(new Cookie([
                'name' => 'device_id',
                'value' => $device->device_id,
                'expire' => time() + $duration,
            ]));

            return Yii::$app->user->login($this->_user, $duration);
        }
        
        return false;
    }
}
