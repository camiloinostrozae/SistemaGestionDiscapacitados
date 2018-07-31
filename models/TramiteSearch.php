<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tramite;

/**
 * TramiteSearch represents the model behind the search form of `app\models\Tramite`.
 */
class TramiteSearch extends Tramite
{
    /**
     * @inheritdoc
     */
    public $tipo;
    
    public function rules()
    {
        return [
            [['id_tramite', 'id_tipo_tramite'], 'integer'],
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
        $query = Tramite::find() 
            ->joinWith(['tipoTramite']);

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
            'id_tramite' => $this->id_tramite,
            'fecha_publicacion' => $this->fecha_publicacion,
            'fecha_vencimiento' => $this->fecha_vencimiento,
            'id_tipo_tramite' => $this->id_tipo_tramite,
        ]);

        $query->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'contenido', $this->contenido])
            ->andFilterWhere(['like', 'estado', $this->estado])
            ->andFilterWhere(['like', 'tipo', $this->tipo]);

        return $dataProvider;
    }
}
