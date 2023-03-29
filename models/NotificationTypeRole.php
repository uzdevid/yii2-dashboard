<?php

namespace uzdevid\dashboard\models;

use uzdevid\dashboard\components\BaseModel;
use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "notification_type_role".
 *
 * @property int $id
 * @property int $notification_type_id
 * @property int $role_id
 *
 * @property NotificationType $notificationType
 * @property Role $role
 */
class NotificationTypeRole extends BaseModel {
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string {
        return 'notification_type_role';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array {
        return [
            [['notification_type_id', 'role_id'], 'required'],
            [['notification_type_id', 'role_id'], 'integer'],
            [['notification_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => NotificationType::class, 'targetAttribute' => ['notification_type_id' => 'id']],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::class, 'targetAttribute' => ['role_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array {
        return [
            'id' => Yii::t('system.model', 'ID'),
            'notification_type_id' => Yii::t('system.model', 'Notification Type ID'),
            'role_id' => Yii::t('system.model', 'Role ID'),
        ];
    }

    /**
     * Gets query for [[NotificationType]].
     *
     * @return ActiveQuery
     */
    public function getNotificationType(): ActiveQuery {
        return $this->hasOne(NotificationType::class, ['id' => 'notification_type_id']);
    }

    /**
     * Gets query for [[Role]].
     *
     * @return ActiveQuery
     */
    public function getRole(): ActiveQuery {
        return $this->hasOne(Role::class, ['id' => 'role_id']);
    }
}
