<?php

namespace uzdevid\dashboard\modules\system;

use uzdevid\dashboard\access\control\controllers\ActionController;
use uzdevid\dashboard\events\ModuleEvent;
use uzdevid\dashboard\modify\log\controllers\ModifyLogController;
use Yii;
use yii\base\ActionEvent;
use yii\web\Response;

/**
 * system module definition class
 */
class Module extends \yii\base\Module {
    public const EVENT_BEFORE_INIT = 'beforeInit';
    public const EVENT_AFTER_INIT = 'afterInit';
    
    /**
     * {@inheritdoc}
     */
    public function init() {
        Yii::$app->trigger(self::EVENT_BEFORE_INIT, new ModuleEvent($this));

        parent::init();

        Yii::$app->trigger(self::EVENT_AFTER_INIT, new ModuleEvent($this));
    }
}
