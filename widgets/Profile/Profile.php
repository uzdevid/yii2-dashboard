<?php

namespace uzdevid\dashboard\widgets\Profile;

use Yii;
use yii\base\Widget;

class Profile extends Widget {
    /**
     * @return string
     */
    public function run(): string {
        $user = Yii::$app->user->identity;

        return $this->render('index', compact('user'));
    }
}