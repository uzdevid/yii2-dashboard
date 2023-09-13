<?php

namespace uzdevid\dashboard\models\base;

use Yii;

/**
 * This is the model class for table "message".
 *
 * @property int $id
 * @property string $language
 * @property string|null $translation
 *
 * @property SourceMessage $id0
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'language'], 'required'],
            [['id'], 'default', 'value' => null],
            [['id'], 'integer'],
            [['translation'], 'string'],
            [['language'], 'string', 'max' => 16],
            [['id', 'language'], 'unique', 'targetAttribute' => ['id', 'language']],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => SourceMessage::class, 'targetAttribute' => ['id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('system.model', 'ID'),
            'language' => Yii::t('system.model', 'Language'),
            'translation' => Yii::t('system.model', 'Translation'),
        ];
    }

    /**
     * Gets query for [[Id0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(SourceMessage::class, ['id' => 'id']);
    }
}
