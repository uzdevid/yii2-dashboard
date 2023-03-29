<?php

namespace uzdevid\dashboard\models\service;

use uzdevid\dashboard\models\User;
use Yii;
use yii\base\Exception;
use yii\web\UploadedFile;

class UserService {
    public static function sendLoginDetails(string $email, string $password): void {
        Yii::$app->mailer->compose('login-details', ['password' => $password, 'link' => Yii::$app->params['inviteLink']])
            ->setFrom(Yii::$app->params['adminEmail'])
            ->setTo($email)
            ->setSubject('Login')
            ->send();
    }

    public static function canIDeleteUser(User $user): bool {
        return $user->user_id == Yii::$app->user->id;
    }

    /**
     * @param User $user
     * @param UploadedFile|null $image
     * @return bool|string|null
     * @throws Exception
     */
    public static function uploadImage(User &$user, UploadedFile|null $image): null|bool|string {
        if (empty($image)) {
            return $user->image;
        } elseif (!empty($user->image)) {
            $path = Yii::getAlias('@webroot') . "/storage/profile/photo/{$user->image}";
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $user->image = $image;

        if (!$user->validate(['file'])) {
            return false;
        }

        $filename = Yii::$app->security->generateRandomString(6) . '.' . $user->image->extension;
        $user->image->saveAs(Yii::getAlias('@webroot') . "/storage/profile/photo/{$filename}");
        return $filename;
    }
}