<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tramite".
 *
 * @property int $id_tramite
 * @property string $titulo
 * @property string $contenido
 * @property string $fecha_publicacion
 * @property string $fecha_vencimiento
 * @property string $estado
 * @property int $id_tipo_tramite
 *
 * @property InteractuarTramite[] $interactuarTramites
 * @property Persona[] $personaIdPersonas
 * @property TipoTramite $tipoTramite
 */
class Tramite extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tramite';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['titulo', 'contenido', 'fecha_publicacion', 'fecha_vencimiento', 'estado', 'id_tipo_tramite'], 'required'],
            [['titulo', 'contenido'], 'string'],
            [['fecha_publicacion', 'fecha_vencimiento'], 'safe'],
            [['id_tipo_tramite'], 'integer'],
            [['estado'], 'string', 'max' => 10],
            [['id_tipo_tramite'], 'exist', 'skipOnError' => true, 'targetClass' => TipoTramite::className(), 'targetAttribute' => ['id_tipo_tramite' => 'id_tipo_tramite']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_tramite' => 'Id Tramite',
            'titulo' => 'Titulo',
            'contenido' => 'Contenido',
            'fecha_publicacion' => 'Fecha Publicacion',
            'fecha_vencimiento' => 'Fecha Vencimiento',
            'estado' => 'Estado',
            'id_tipo_tramite' => 'Id Tipo Tramite',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInteractuarTramites()
    {
        return $this->hasMany(InteractuarTramite::className(), ['tramite_id_tramite' => 'id_tramite']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonaIdPersonas()
    {
        return $this->hasMany(Persona::className(), ['id_persona' => 'persona_id_persona'])->viaTable('interactuar_tramite', ['tramite_id_tramite' => 'id_tramite']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoTramite()
    {
        return $this->hasOne(TipoTramite::className(), ['id_tipo_tramite' => 'id_tipo_tramite']);
    }
}
