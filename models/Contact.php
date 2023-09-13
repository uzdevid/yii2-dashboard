<?php

namespace uzdevid\dashboard\models;

use Yii;
use yii\behaviors\BlameableBehavior;

/**
 * @property string $translatedType
 */
class Contact extends base\Contact {
    public function getTranslatedType(): string {
        return Yii::t('system.model', $this->type);
    }

    public function behaviors(): array {
        $behaviors = parent::behaviors();

        $behaviors['BlameableBehavior'] = [
            'class' => BlameableBehavior::class,
            'attributes' => [
                self::EVENT_BEFORE_INSERT => ['user_id'],
            ]
        ];
        
        return $behaviors;
    }
}
