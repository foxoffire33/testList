<?php

namespace common\models\search;

use common\models\Andwoord;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * AndwoordSearch represents the model behind the search form about `common\models\Andwoord`.
 */
class AndwoordSearch extends Andwoord
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vraag_id'], 'string'],
            [['text', 'created', 'updated'], 'safe'],
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
        $query = Andwoord::find();

        $query->joinWith('vraag');
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

        $query->andFilterWhere(['like', 'text', $this->text]);

        $query->andFilterWhere(['like', 'vraag.text', $this->vraag_id]);

        return $dataProvider;
    }
}
