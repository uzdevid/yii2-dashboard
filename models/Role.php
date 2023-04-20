<?php

namespace uzdevid\dashboard\models;

use uzdevid\dashboard\overrides\BaseModel;
use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "role".
 *
 * @property int $id
 * @property string $name
 *
 * @property NotificationTypeRole[] $notificationTypeRoles
 * @property User[] $users
 *
 * @property string $translatedName
 */
class Role extends BaseModel {
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string {
        return 'role';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array {
        return [
            'id' => Yii::t('system.model', 'ID'),
            'name' => Yii::t('system.model', 'Name'),
        ];
    }

    /**
     * Gets query for [[NotificationTypeRoles]].
     *
     * @return ActiveQuery
     */
    public function getNotificationTypeRoles(): ActiveQuery {
        return $this->hasMany(NotificationTypeRole::class, ['role_id' => 'id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return ActiveQuery
     */
    public function getUsers(): ActiveQuery {
        return $this->hasMany(User::class, ['role_id' => 'id']);
    }

    public function getTranslatedName(): string {
        return Yii::t('system.role', $this->name);
    }
}
