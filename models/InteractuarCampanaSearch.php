<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\InteractuarCampana;

/**
 * InteractuarCampanaSearch represents the model behind the search form of `app\models\InteractuarCampana`.
 */
class InteractuarCampanaSearch extends InteractuarCampana
{
    /**
     * @inheritdoc
     */
    public $nombre;
    public $apellido;
    public $fecha_nacimiento;
    public $sexo;
    public $tipo;
    public $nombreComuna;
    public $titulo;
    public $fecha_publicacion;
    public $estado;
    public function rules()
    {
        return [
            [['persona_id_persona', 'campana_id_campana'], 'integer'],
            [['fecha', 'hora', 'nombre','apellido','fecha_nacimiento','sexo','tipo', 'nombreComuna','titulo','fecha_publicacion','estado'], 'safe'],
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
        $query = InteractuarCampana::find()
            ->joinWith(['personaIdPersona'])
            ->joinWith(['personaIdPersona.rolIdRol'])
             ->joinWith(['personaIdPersona.comunaIdComuna'])
             ->joinWith(['campanaIdCampana']);

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
            'campana_id_campana' => $this->campana_id_campana,
            'fecha' => $this->fecha,
            'hora' => $this->hora,
        ]);
        
              $query->andFilterWhere(['like', 'nombre', $this->nombre])
              ->andFilterWhere(['like', 'apellido', $this->apellido])
             ->andFilterWhere(['like', 'fecha_nacimiento', $this->fecha_nacimiento])
              ->andFilterWhere(['like', 'sexo', $this->sexo])
                ->andFilterWhere(['like', 'tipo', $this->tipo])
                  ->andFilterWhere(['like', 'nombreComuna', $this->nombreComuna])
                  ->andFilterWhere(['like', 'titulo', $this->titulo])
                  ->andFilterWhere(['like', 'fecha_publicacion', $this->fecha_publicacion])
                  ->andFilterWhere(['like', 'estado', $this->estado]);

        return $dataProvider;
    }
}
