<?php

namespace uzdevid\dashboard\models\service;

use Yii;

class ContactService {
    public static function typesList(): array {
        return [
            'email' => Yii::t('system.contact', 'Email'),
            'phone' => Yii::t('system.contact', 'Phone'),
            'address' => Yii::t('system.contact', 'Address'),
        ];
    }
}