<?php

namespace uzdevid\dashboard\models\service;

class LanguageService {
    public static function list(): array {
        return [
            'uz' => 'O\'zbekcha',
            'en' => 'English',
            'ru' => 'Русский',
        ];
    }
}