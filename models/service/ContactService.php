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

    public static function createLink($type, $value): string {
        return match ($type) {
            'email' => 'mailto:' . $value,
            'phone' => 'tel:' . $value,
            'address' => 'https://www.google.com/maps/search/?api=1&query=' . $value,
        };
    }
}