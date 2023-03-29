<?php

namespace uzdevid\dashboard\models\search;

use uzdevid\dashboard\models\NotificationType;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * NotificationTypeSearch represents the model behind the search form of `uzdevid\dashboard\models\NotificationType`.
 */
class NotificationTypeSearch extends NotificationType {
    /**
     * {@inheritdoc}
     */
    public function rules(): array {
        return [
            [['id'], 'integer'],
            [['name', 'icon', 'behavior'], 'safe'],
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
        $query = NotificationType::find();

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

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'icon', $this->icon])
            ->andFilterWhere(['like', 'behavior', $this->behavior]);

        return $dataProvider;
    }
}
