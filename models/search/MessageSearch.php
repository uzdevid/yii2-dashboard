<?php

namespace uzdevid\dashboard\models\search;

use uzdevid\dashboard\models\Message;
use uzdevid\dashboard\models\YiiMessage as YiiMessageModel;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * YiiMessageSearch represents the model behind the search form of `uzdevid\dashboard\models\YiiMessageSearch`.
 */
class MessageSearch extends Message {
    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id'], 'integer'],
            [['language', 'translation'], 'safe'],
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
        $query = Message::find();

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

        $query->andFilterWhere(['like', 'language', $this->language])
            ->andFilterWhere(['like', 'translation', $this->translation]);

        return $dataProvider;
    }
}
