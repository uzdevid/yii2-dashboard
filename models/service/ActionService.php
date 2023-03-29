<?php

namespace uzdevid\dashboard\models\service;

use uzdevid\dashboard\models\Action;
use uzdevid\dashboard\models\ActionUser;

class ActionService {
    /**
     * @return array
     */
    public static function getActions(): array {
        return Action::find()->orderBy(['path' => SORT_ASC])->all();
    }

    /**
     * @param $userId
     * @param $actionId
     * @return bool
     */
    public static function canUserDoAction($userId, $actionId): bool {
        return ActionUser::find()->where(['user_id' => $userId, 'action_id' => $actionId])->exists();
    }
}