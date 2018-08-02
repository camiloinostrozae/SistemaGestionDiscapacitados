<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Llamada;

/**
 * LlamadaSearch represents the model behind the search form of `app\models\Llamada`.
 */
class LlamadaSearch extends Llamada
{
    /**
     * @inheritdoc
     */
    public $nombre;
    public $apellido;
    public $telefono;
     public $latitud;
     public $longitud;
    
    public function rules()
    {
        return [
            [['id_llamada', 'ubicacion_id_ubicacion', 'persona_id_persona'], 'integer'],
            [['fecha', 'hora','telefono','nombre','apellido', 'latitud','longitud'], 'safe'],
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
        $query = Llamada::find()
             ->joinWith(['personaIdPersona'])
            ->joinWith(['ubicacionIdUbicacion']);

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
            'id_llamada' => $this->id_llamada,
            'fecha' => $this->fecha,
            'hora' => $this->hora,
            'ubicacion_id_ubicacion' => $this->ubicacion_id_ubicacion,
            'persona_id_persona' => $this->persona_id_persona,
        ]);
        
        $query->andFilterWhere(['like', 'telefono', $this->telefono])
             ->andFilterWhere(['like', 'nombre', $this->nombre])
             ->andFilterWhere(['like', 'apellido', $this->apellido])
            ->andFilterWhere(['like', 'latitud', $this->latitud])
            ->andFilterWhere(['like', 'longitud', $this->longitud]);

        return $dataProvider;
    }
}
