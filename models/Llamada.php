<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "llamada".
 *
 * @property int $id_llamada
 * @property string $fecha
 * @property string $hora
 * @property int $ubicacion_id_ubicacion
 * @property int $persona_id_persona
 *
 * @property Ubicacion $ubicacionIdUbicacion
 * @property Persona $personaIdPersona
 */
class Llamada extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'llamada';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha', 'hora', 'ubicacion_id_ubicacion', 'persona_id_persona'], 'required'],
            [['fecha', 'hora'], 'safe'],
            [['ubicacion_id_ubicacion', 'persona_id_persona'], 'integer'],
            [['ubicacion_id_ubicacion'], 'exist', 'skipOnError' => true, 'targetClass' => Ubicacion::className(), 'targetAttribute' => ['ubicacion_id_ubicacion' => 'id_ubicacion']],
            [['persona_id_persona'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['persona_id_persona' => 'id_persona']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_llamada' => 'Id Llamada',
            'fecha' => 'Fecha',
            'hora' => 'Hora',
            'ubicacion_id_ubicacion' => 'Ubicacion Id Ubicacion',
            'persona_id_persona' => 'Persona Id Persona',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUbicacionIdUbicacion()
    {
        return $this->hasOne(Ubicacion::className(), ['id_ubicacion' => 'ubicacion_id_ubicacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonaIdPersona()
    {
        return $this->hasOne(Persona::className(), ['id_persona' => 'persona_id_persona']);
    }
}
