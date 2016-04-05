<?php

namespace common\models\search;

use common\models\Score;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ScoreSearch represents the model behind the search form about `common\models\Score`.
 */
class ScoreSearch extends Score
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client_test_id', 'antwoord_id'], 'string'],
            [['created', 'updated'], 'safe'],
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
        $query = Score::find();

        $query->joinWith(['clientTest.test', 'andwoord']);

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
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'test.name', $this->client_test_id]);
        $query->andFilterWhere(['like', 'antwoord.text', $this->antwoord_id]);

        return $dataProvider;
    }
}
