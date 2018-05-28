<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "interactuar_tramite".
 *
 * @property int $persona_id_persona
 * @property int $tramite_id_tramite
 * @property string $fecha
 * @property string $hora
 *
 * @property Persona $personaIdPersona
 * @property Tramite $tramiteIdTramite
 */
class InteractuarTramite extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'interactuar_tramite';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['persona_id_persona', 'tramite_id_tramite', 'fecha', 'hora'], 'required'],
            [['persona_id_persona', 'tramite_id_tramite'], 'integer'],
            [['fecha', 'hora'], 'safe'],
            [['persona_id_persona', 'tramite_id_tramite'], 'unique', 'targetAttribute' => ['persona_id_persona', 'tramite_id_tramite']],
            [['persona_id_persona'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['persona_id_persona' => 'id_persona']],
            [['tramite_id_tramite'], 'exist', 'skipOnError' => true, 'targetClass' => Tramite::className(), 'targetAttribute' => ['tramite_id_tramite' => 'id_tramite']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'persona_id_persona' => 'Nombre',
            'tramite_id_tramite' => 'Tramite Id Tramite',
            'fecha' => 'Fecha Acceso',
            'hora' => 'Hora Acceso',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonaIdPersona()
    {
        return $this->hasOne(Persona::className(), ['id_persona' => 'persona_id_persona']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTramiteIdTramite()
    {
        return $this->hasOne(Tramite::className(), ['id_tramite' => 'tramite_id_tramite']);
    }
    
    public function getComunaIdComuna()
    {
        return $this->hasOne(Comuna::className(), ['id_comuna' => 'comuna_id_comuna'])->viaTable('persona', ['id_persona' => 'persona_id_persona']);
    }
      public function getRolIdRol()
    {
        return $this->hasOne(Rol::className(), ['id_rol' => 'rol_id_rol'])->viaTable('persona', ['id_persona' => 'persona_id_persona']);
    }
    
    
}
