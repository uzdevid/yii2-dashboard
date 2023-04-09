<?php

namespace uzdevid\dashboard\models\search;

use uzdevid\dashboard\models\ModifyLog;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ModifyLogSearch represents the model behind the search form of `uzdevid\dashboard\models\ModifyLog`.
 */
class ModifyLogSearch extends ModifyLog {
    /**
     * {@inheritdoc}
     */
    public function rules(): array {
        return [
            [['id', 'user_id', 'model_id', 'modify_time'], 'integer'],
            [['model', 'attribute', 'value', 'old_value'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        $query = ModifyLog::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'model_id' => $this->model_id,
            'modify_time' => $this->modify_time,
        ]);

        $query->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'attribute', $this->attribute])
            ->andFilterWhere(['like', 'value', $this->value])
            ->andFilterWhere(['like', 'old_value', $this->old_value]);

        return $dataProvider;
    }
}
