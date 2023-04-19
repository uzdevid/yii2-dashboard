<?php

namespace uzdevid\dashboard\widgets\Footer;

use yii\base\Widget;

class Footer extends Widget {
    /**
     * @return string
     */
    public function run(): string {
        return $this->render('index');
    }
}