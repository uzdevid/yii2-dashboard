<?php

namespace uzdevid\dashboard\events;

use yii\base\Event;

class ModuleEvent extends Event {
    public object $module;

    public function __construct($module, $config = []) {
        $this->module = $module;
        parent::__construct($config);
    }
}