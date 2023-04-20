<?php

namespace uzdevid\dashboard\models;

use uzdevid\dashboard\overrides\BaseModel;
use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "yii_source_message".
 *
 * @property int $id
 * @property string $category
 * @property string $message
 *
 * @property YiiMessage[] $yiiMessages
 */
class YiiSourceMessage extends BaseModel {
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string {
        return 'yii_source_message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array {
        return [
            [['category', 'message'], 'required'],
            [['message'], 'string'],
            [['category'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array {
        return [
            'id' => Yii::t('system.model', 'ID'),
            'category' => Yii::t('system.model', 'Category'),
            'message' => Yii::t('system.model', 'Message'),
        ];
    }

    /**
     * Gets query for [[YiiMessages]].
     *
     * @return ActiveQuery
     */
    public function getYiiMessages(): ActiveQuery {
        return $this->hasMany(YiiMessage::class, ['id' => 'id']);
    }
}
