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
            'titulo' => 'Título',
            'contenido' => 'Contenido',
            'fecha_publicacion' => 'Fecha Publicación',
            'fecha_vencimiento' => 'Fecha Vencimiento',
            'estado' => 'Estado',
            'id_tipo_tramite' => 'Tipo de Trámite',
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
    
     public function beforeSave($insert){
        //Se formatea al formato que guarda MYSQL
        $time = date("Y-m-d", strtotime($this->fecha_publicacion));
        $time2 = date("Y-m-d", strtotime($this->fecha_vencimiento));
        if ($time && $time2) {
            $this->fecha_publicacion = $time;
            $this->fecha_vencimiento = $time2;
            return parent::beforeSave($insert);
        }
        else {
            return false;
        }

    }
}
