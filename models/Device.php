<?php

namespace uzdevid\dashboard\models;

use WhichBrowser\Parser;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\BaseActiveRecord;

/**
 * @property string $deviceName
 */
class Device extends base\Device {
    public function rules(): array {
        return [
            [['user_id', 'name'], 'required'],
            [['user_id', 'authorization_time', 'last_activity_time'], 'integer'],
            [['authorization_time', 'last_activity_time'], 'safe'],
            [['name', 'device_id'], 'string', 'max' => 255],
            [['access_token'], 'string', 'max' => 32],
            [['type'], 'string', 'max' => 45],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function behaviors(): array {
        $behaviors = parent::behaviors();
        $behaviors['timestamp'] = [
            'class' => TimestampBehavior::class,
            'attributes' => [
                BaseActiveRecord::EVENT_BEFORE_INSERT => ['last_activity_time', 'authorization_time'],
            ]
        ];

        return $behaviors;
    }

    public function beforeSave($insert): bool {
        if ($insert) {
            $this->device_id = Yii::$app->security->generateRandomString();
            $this->access_token = Yii::$app->security->generateRandomString();
            $this->type = 'web';
        }
        return parent::beforeSave($insert);
    }

    public function getDeviceName(): string {
        if ($this->type != 'web') {
            return $this->name;
        }

        $parser = new Parser($this->name);
        return "{$parser->os->toString()} {$parser->browser->toString()}";
    }

    /**
     * @throws InvalidConfigException
     */
    public function getFormattedAuthTime(): ?string {
        return Yii::$app->formatter->asDatetime($this->authorization_time);
    }
}