<?php

namespace uzdevid\dashboard\models;

use uzdevid\dashboard\components\BaseModel;
use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "action".
 *
 * @property int $id
 * @property string $path
 *
 * @property Action $action
 * @property ActionUser[] $users
 */
class Action extends BaseModel {
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string {
        return 'action';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array {
        return [
            [['path'], 'required'],
            [['path'], 'string', 'max' => 255],
            [['path'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array {
        return [
            'id' => Yii::t('system.model', 'ID'),
            'path' => Yii::t('system.model', 'Action Path'),
        ];
    }

    /**
     * Gets query for [[Users]].
     *
     * @return ActiveQuery
     */
    public function getUsers(): ActiveQuery {
        return $this->hasMany(ActionUser::class, ['action_id' => 'id']);
    }

    public function getTitle(): string {
        return Yii::t('system.action', $this->path);
    }
}
