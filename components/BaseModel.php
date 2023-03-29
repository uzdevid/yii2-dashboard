<?php

namespace uzdevid\dashboard\components;

use uzdevid\dashboard\models\ModifyLog;
use Yii;
use yii\db\ActiveRecord;

class BaseModel extends ActiveRecord {

    /**
     * @param $insert
     * @param $changedAttributes
     * @return void
     */

    public function afterSave($insert, $changedAttributes): void {
        if ($insert) {
            return;
        }

        foreach ($changedAttributes as $key => $value) {
            if ($this->$key == $value) {
                continue;
            }

            $modify = new ModifyLog();
            $modify->user_id = Yii::$app->user->id;
            $modify->model = $this->tableName();
            $modify->model_id = $this->id;
            $modify->attribute = $key;
            $modify->value = $this->$key;
            $modify->old_value = $value;
            $modify->save();
        }

        parent::afterSave($insert, $changedAttributes);
    }

    public function afterDelete() {
        $modify = new ModifyLog();
        $modify->user_id = Yii::$app->user->id;
        $modify->model = $this->tableName();
        $modify->model_id = $this->id;
        $modify->attribute = 'this';
        $modify->value = null;
        $modify->old_value = json_encode($this->attributes);
        $modify->modify_time = time();
        $modify->save();

        parent::afterDelete();
    }
}