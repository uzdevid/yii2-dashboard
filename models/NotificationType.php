<?php

namespace uzdevid\dashboard\models;

use uzdevid\dashboard\components\BaseModel;
use Yii;
use yii\db\ActiveQuery;

/**
 * @property int $id
 * @property string $name
 * @property string $icon
 * @property string $behavior
 *
 * @property NotificationTypeRole[] $notificationTypeRoles
 * @property Notification[] $notifications
 *
 * @property string $translatedTitle
 */
class NotificationType extends BaseModel {
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string {
        return 'notification_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array {
        return [
            [['name', 'icon'], 'required'],
            [['name', 'icon', 'behavior'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array {
        return [
            'id' => Yii::t('system.model', 'ID'),
            'name' => Yii::t('system.model', 'Name'),
            'icon' => Yii::t('system.model', 'Notification Icon'),
            'behavior' => Yii::t('system.model', 'Notification Behavior'),
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getNotificationTypeRoles(): ActiveQuery {
        return $this->hasMany(NotificationTypeRole::class, ['notification_type_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getNotifications(): ActiveQuery {
        return $this->hasMany(Notification::class, ['notification_type_id' => 'id']);
    }
}
