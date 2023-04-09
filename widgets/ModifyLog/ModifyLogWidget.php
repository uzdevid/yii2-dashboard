<?php

namespace uzdevid\dashboard\widgets\ModifyLog;

use uzdevid\dashboard\models\ModifyLog;
use yii\data\ArrayDataProvider;

class ModifyLogWidget extends \yii\bootstrap5\Widget {
    public $model;
    public $id;
    public $limit = 10;

    public function run() {
        $dataProvider = new ArrayDataProvider([
            'allModels' => ModifyLog::find()->where(['model' => $this->model, 'model_id' => $this->id])->limit($this->limit)->all(),
            'pagination' => false,
            'sort' => [
                'attributes' => ['id', 'modify_time', 'user_id', 'attribute'],
                'defaultOrder' => ['modify_time' => SORT_DESC],
            ]
        ]);

        $model = $this->model;
        $id = $this->id;

        return $this->render('modify-log', compact('dataProvider', 'model', 'id'));
    }
}