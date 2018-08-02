<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Comuna;

/**
 * ComunaSearch represents the model behind the search form of `app\models\Comuna`.
 */
class ComunaSearch extends Comuna
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_comuna', 'region_id_region'], 'integer'],
            [['nombreComuna'], 'safe'],
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
        $query = Comuna::find();

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
            'id_comuna' => $this->id_comuna,
            'region_id_region' => $this->region_id_region,
        ]);

        $query->andFilterWhere(['like', 'nombreComuna', $this->nombreComuna]);

        return $dataProvider;
    }
}
