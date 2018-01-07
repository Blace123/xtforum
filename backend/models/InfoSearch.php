<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Info;

/**
 * InfoSearch represents the model behind the search form of `backend\models\Info`.
 */
class InfoSearch extends Info
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'title', 'content', 'brief', 'image', 'create_at', 'class', 'user_id'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
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
    public function search($params)
    {
        $query = Info::find();

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
        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'brief', $this->brief])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'create_at', $this->create_at])
            ->andFilterWhere(['like', 'class', $this->class])
            ->andFilterWhere(['like', 'user_id', $this->user_id]);

        return $dataProvider;
    }
}
