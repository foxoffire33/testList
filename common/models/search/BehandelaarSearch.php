<?php

namespace common\models\search;

use common\models\Behandelaar;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * BehandelaarSearch represents the model behind the search form about `common\models\Behandelaar`.
 */
class BehandelaarSearch extends Behandelaar
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'string'],
            [['first_name', 'last_name', 'created', 'updated'], 'safe'],
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
        $query = Behandelaar::find();

        $query->joinWith('user');

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

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name]);

        $query->andFilterWhere(['like', 'user.username', $this->user_id]);

        return $dataProvider;
    }
}
