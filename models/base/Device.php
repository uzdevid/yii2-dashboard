<?php

namespace uzdevid\dashboard\models\base;

use Yii;

/**
 * This is the model class for table "device".
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $device_id
 * @property string $access_token
 * @property string $type
 * @property int $last_activity_time
 * @property int $authorization_time
 *
 * @property User $user
 */
class Device extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'device';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'name', 'device_id', 'access_token', 'type', 'last_activity_time', 'authorization_time'], 'required'],
            [['user_id', 'last_activity_time', 'authorization_time'], 'default', 'value' => null],
            [['user_id', 'last_activity_time', 'authorization_time'], 'integer'],
            [['name', 'device_id', 'access_token'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 32],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('system.model', 'ID'),
            'user_id' => Yii::t('system.model', 'User ID'),
            'name' => Yii::t('system.model', 'Name'),
            'device_id' => Yii::t('system.model', 'Device ID'),
            'access_token' => Yii::t('system.model', 'Access Token'),
            'type' => Yii::t('system.model', 'Type'),
            'last_activity_time' => Yii::t('system.model', 'Last Activity Time'),
            'authorization_time' => Yii::t('system.model', 'Authorization Time'),
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
