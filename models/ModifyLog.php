<?php

namespace uzdevid\dashboard\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\BaseActiveRecord;

/**
 * This is the model class for table "modify_log".
 *
 * @property int $id
 * @property int $user_id
 * @property int $model
 * @property int $model_id
 * @property string $attribute
 * @property string|null $value
 * @property string|null $old_value
 * @property int $modify_time
 *
 * @property User $user
 */
class ModifyLog extends ActiveRecord {
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string {
        return 'modify_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array {
        return [
            [['user_id', 'model_id', 'attribute'], 'required'],
            [['user_id', 'model_id', 'modify_time'], 'integer'],
            [['value', 'old_value'], 'string'],
            [['modify_time'], 'safe'],
            [['attribute'], 'string', 'max' => 255],
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
            'system.model_id' => Yii::t('system.model', 'system.model ID'),
            'attribute' => Yii::t('system.model', 'Attribute'),
            'value' => Yii::t('system.model', 'Value'),
            'old_value' => Yii::t('system.model', 'Old Value'),
            'modify_time' => Yii::t('system.model', 'Modify Time'),
        ];
    }

    public function behaviors(): array {
        $behaviors = parent::behaviors();
        $behaviors['timestamp'] = [
            'class' => TimestampBehavior::class,
            'attributes' => [
                BaseActiveRecord::EVENT_BEFORE_INSERT => ['modify_time'],
            ],
            'value' => time()
        ];

        return $behaviors;
    }

    /**
     * Gets query for [[User]].
     *
     * @return ActiveQuery
     */
    public function getUser(): ActiveQuery {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
