<?php

namespace uzdevid\dashboard\widgets;

use uzdevid\dashboard\models\ModifyLog;
use yii\data\ActiveDataProvider;

class ModifyLogWidget extends \yii\bootstrap5\Widget {
    public $model;
    public $id;

    public function run() {
        $dataProvider = new ActiveDataProvider([
            'query' => ModifyLog::find()->where(['model' => $this->model, 'model_id' => $this->id]),
            'pagination' => [
                'pageSize' => 15,
                'pageParam' => 'modify-log-page',
                'pageSizeParam' => 'modify-log-page-size'
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                    'modify_time' => SORT_DESC
                ]
            ]
        ]);

        return $this->render('modify-log', compact('dataProvider'));
    }
}