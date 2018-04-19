<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\InteractuarTramite;

/**
 * InteractuarTramiteSearch represents the model behind the search form of `app\models\InteractuarTramite`.
 */
class InteractuarTramiteSearch extends InteractuarTramite
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['persona_id_persona', 'tramite_id_tramite'], 'integer'],
            [['fecha', 'hora'], 'safe'],
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
        $query = InteractuarTramite::find();

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
            'persona_id_persona' => $this->persona_id_persona,
            'tramite_id_tramite' => $this->tramite_id_tramite,
            'fecha' => $this->fecha,
            'hora' => $this->hora,
        ]);

        return $dataProvider;
    }
}