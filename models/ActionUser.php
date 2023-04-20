<?php

namespace uzdevid\dashboard\models;

use uzdevid\dashboard\base\db\ActiveRecord;
use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "action_user".
 *
 * @property int $id
 * @property int $action_id
 * @property int $user_id
 *
 * @property Action $action
 * @property User $user
 */
class ActionUser extends ActiveRecord {
    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'action_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['action_id', 'user_id'], 'required'],
            [['action_id', 'user_id'], 'integer'],
            [['action_id'], 'exist', 'skipOnError' => false, 'targetClass' => Action::class, 'targetAttribute' => ['action_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => false, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('system.model', 'ID'),
            'action_id' => Yii::t('system.model', 'Action ID'),
            'user_id' => Yii::t('system.model', 'User ID'),
        ];
    }

    /**
     * Gets query for [[Action]].
     *
     * @return ActiveQuery
     */
    public function getAction() {
        return $this->hasOne(Action::class, ['id' => 'action_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
