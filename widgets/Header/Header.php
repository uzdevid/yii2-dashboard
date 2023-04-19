<?php

namespace uzdevid\dashboard\widgets\Header;

use yii\base\Widget;

class Header extends Widget {
    /**
     * @return string
     */
    public function run(): string {
        return $this->render('index');
    }
}