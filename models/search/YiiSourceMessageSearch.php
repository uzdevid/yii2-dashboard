<?php

namespace uzdevid\dashboard\models\search;

use uzdevid\dashboard\models\YiiSourceMessage;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * YiiSourceMessageSearch represents the model behind the search form of `uzdevid\dashboard\models\YiiSourceMessage`.
 */
class YiiSourceMessageSearch extends YiiSourceMessage {
    /**
     * {@inheritdoc}
     */
    public function rules(): array {
        return [
            [['id'], 'integer'],
            [['category', 'message'], 'safe'],
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
        $query = YiiSourceMessage::find();

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
        ]);

        $query->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'message', $this->message]);

        return $dataProvider;
    }
}
