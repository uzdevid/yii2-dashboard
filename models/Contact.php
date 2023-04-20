<?php

namespace uzdevid\dashboard\models;

use uzdevid\dashboard\overrides\BaseModel;
use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "contact".
 *
 * @property int $id
 * @property int $user_id
 * @property string $type
 * @property string $contact
 *
 * @property User $user
 *
 * @property string $translatedType
 */
class Contact extends BaseModel {
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string {
        return 'contact';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['type', 'contact'], 'required'],
            [['user_id'], 'integer'],
            [['type', 'contact'], 'string', 'max' => 32],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array {
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
     * @return ActiveQuery
     */
    public function getUser(): ActiveQuery {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getTranslatedType(): string {
        return Yii::t('system.model', $this->type);
    }

    public function beforeSave($insert): bool {
        $this->user_id = Yii::$app->user->id;
        return parent::beforeSave($insert);
    }
}
