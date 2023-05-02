<?php

namespace uzdevid\dashboard\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "yii_message".
 *
 * @property int $id
 * @property string $language
 * @property string $translation
 *
 * @property YiiSourceMessage $sourceMessage
 */
class YiiMessage extends ActiveRecord {
    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'language', 'translation'], 'required'],
            [['id'], 'integer'],
            [['translation'], 'string'],
            [['language'], 'string', 'max' => 16],
            [['id', 'language'], 'unique', 'targetAttribute' => ['id', 'language']],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => YiiSourceMessage::class, 'targetAttribute' => ['id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('system.model', 'ID'),
            'language' => Yii::t('system.model', 'Language'),
            'translation' => Yii::t('system.model', 'Translation'),
        ];
    }

    /**
     * Gets query for [[SourceMessage]].
     *
     * @return ActiveQuery
     */
    public function getSourceMessage() {
        return $this->hasOne(YiiSourceMessage::class, ['id' => 'id']);
    }
}
