<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Campana;
use app\models\TipoCampana;

/**
 * CampanaSearch represents the model behind the search form of `app\models\Campana`.
 */
class CampanaSearch extends Campana
{
    /**
     * @inheritdoc
     */
    
    public $tipo;
    public function rules()
    {
        return [
            [['id_campana', 'id_tipo_campana'], 'integer'],
            [['titulo', 'contenido', 'fecha_publicacion', 'fecha_vencimiento', 'estado','tipo'], 'safe'],
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
        $query = Campana::find()
            ->joinWith(['tipoCampana']);

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
            'id_campana' => $this->id_campana,
            'fecha_publicacion' => $this->fecha_publicacion,
            'fecha_vencimiento' => $this->fecha_vencimiento,
            'id_tipo_campana' => $this->id_tipo_campana,
        ]);

        $query->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'contenido', $this->contenido])
            ->andFilterWhere(['like', 'estado', $this->estado])
            ->andFilterWhere(['like', 'tipo', $this->tipo]);

        return $dataProvider;
    }
}
