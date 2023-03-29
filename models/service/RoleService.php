<?php

namespace uzdevid\dashboard\models\service;

use uzdevid\dashboard\models\Role;
use yii\helpers\ArrayHelper;

class RoleService {
    public static function list(): array {
        return ArrayHelper::map(Role::find()->all(), 'id', 'translatedName');
    }
}