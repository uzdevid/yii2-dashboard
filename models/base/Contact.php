<?php

namespace uzdevid\dashboard\models\base;

use Yii;

/**
 * This is the model class for table "contact".
 *
 * @property int $id
 * @property int $user_id
 * @property string $type
 * @property string $contact
 *
 * @property User $user
 */
class Contact extends \yii\db\ActiveRecord {
    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'contact';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['user_id', 'type', 'contact'], 'required'],
            [['user_id'], 'default', 'value' => null],
            [['user_id'], 'integer'],
            [['type', 'contact'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('system.model', 'ID'),
            'user_id' => Yii::t('system.model', 'User ID'),
            'type' => Yii::t('system.model', 'Type'),
            'contact' => Yii::t('system.model', 'Contact'),
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
