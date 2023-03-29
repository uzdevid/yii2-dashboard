<?php

namespace uzdevid\dashboard\models\search;

use uzdevid\dashboard\models\User;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * UserSearch represents the model behind the search form of `uzdevid\dashboard\models\User`.
 */
class UserSearch extends User {
    /**
     * {@inheritdoc}
     */
    public function rules(): array {
        return [
            [['id', 'user_id', 'role_id', 'last_activity_time', 'last_update_time', 'create_time'], 'integer'],
            [['email', 'surname', 'name', 'image', 'language', 'password'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios(): array {
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
    public function search(array $params): ActiveDataProvider {
        $query = User::find();

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
            'role_id' => $this->role_id,
            'last_activity_time' => $this->last_activity_time,
            'last_update_time' => $this->last_update_time,
            'create_time' => $this->create_time,
        ]);

        $query->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'surname', $this->surname])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'language', $this->language])
            ->andFilterWhere(['like', 'password', $this->password]);

        return $dataProvider;
    }
}
