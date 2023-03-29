<?php

namespace uzdevid\dashboard\models\service;

use uzdevid\dashboard\models\Notification;
use uzdevid\dashboard\models\NotificationType;
use uzdevid\dashboard\models\User;
use Yii;
use yii\bootstrap5\Html;

class NotificationService {
    /**
     * @param Notification $notification
     * @return string
     */
    public static function highlightDescription(Notification $notification): string {
        return match ($notification->notificationType->name) {
            "chat.new_message" => Html::tag('em', $notification->description),
            default => $notification->description,
        };
    }

    /**
     * @param Notification $notification
     * @return User|null
     */
    public static function sender(Notification $notification): User|null {
        return User::findOne($notification->arguments?->sender_id);
    }

    /**
     * @param Notification $notification
     * @return string
     */
    public static function icon(Notification $notification): string {
        return Html::tag('i', '', ['class' => $notification->notificationType->icon]);
    }

    public static function title(Notification|NotificationType $notification): string {
        if ($notification instanceof NotificationType)
            return Yii::t('system.notification', $notification->name);

        return Yii::t('system.notification', $notification->notificationType->name, ['sender.fullname' => $notification->sender->fullName]);
    }

    public static function sendTime(Notification $notification): string {
        return Yii::$app->formatter->asRelativeTime($notification->send_time);
    }

    /**
     * @return array
     */
    public static function behaviorsList(): array {
        return [
            'default' => Yii::t('system.notification.behavior', 'default'),
            'hide.after_follow' => Yii::t('system.notification.behavior', 'hide.after_follow'),
        ];
    }
}