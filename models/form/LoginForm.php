<?php

namespace uzdevid\dashboard\models\form;

use uzdevid\dashboard\models\Device;
use uzdevid\dashboard\models\User;
use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class LoginForm extends Model {
    public $email;
    public $password;
    public $rememberMe = true;
    private $_user = null;

    /**
     * @return array the validation rules.
     */
    public function rules(): array {
        return [
            [['email', 'password'], 'required'],
            ['email', 'email'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array {
        return [
            'email' => Yii::t('system.form', 'Email'),
            'password' => Yii::t('system.form', 'Password'),
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array|null $params the additional name-value pairs given in the rule
     */
    public function validatePassword(string $attribute, array|null $params): void {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, Yii::t('system.message', 'Incorrect email or password'));
            }
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser(): ?User {
        if ($this->_user === null) {
            $this->_user = User::findOne(['email' => strtolower($this->email)]);
        }

        return $this->_user;
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login(): bool {
        if ($this->validate()) {
            $device = Device::find()->where(['user_id' => $this->_user->id, 'name' => $_SERVER['HTTP_USER_AGENT']])->one();

            if (is_null($device)) {
                $device = new Device();
                $device->user_id = $this->_user->id;
                $device->name = $_SERVER['HTTP_USER_AGENT'];
                $device->save();
            } else {
                $device->auth_time = time();
                $device->save();
            }

            return Yii::$app->user->login($this->_user, $this->rememberMe ? 3600 * 24 * 30 * 12 * 2 : 0);
        }
        return false;
    }
}
