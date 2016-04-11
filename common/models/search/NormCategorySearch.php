<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\NormCategory;

/**
 * NormCategorySearch represents the model behind the search form about `common\models\NormCategory`.
 */
class NormCategorySearch extends NormCategory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'norm_id', 'category_id'], 'integer'],
            [['score'], 'number'],
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
        $query = NormCategory::find();

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
            'norm_id' => $this->norm_id,
            'category_id' => $this->category_id,
            'score' => $this->score,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        return $dataProvider;
    }
}
