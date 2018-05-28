<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "interactuar_campana".
 *
 * @property int $persona_id_persona
 * @property int $campana_id_campana
 * @property string $fecha
 * @property string $hora
 *
 * @property Persona $personaIdPersona
 * @property Campana $campanaIdCampana
 */
class InteractuarCampana extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'interactuar_campana';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['persona_id_persona', 'campana_id_campana', 'fecha', 'hora'], 'required'],
            [['persona_id_persona', 'campana_id_campana'], 'integer'],
            [['fecha', 'hora'], 'safe'],
            [['persona_id_persona', 'campana_id_campana'], 'unique', 'targetAttribute' => ['persona_id_persona', 'campana_id_campana']],
            [['persona_id_persona'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['persona_id_persona' => 'id_persona']],
            [['campana_id_campana'], 'exist', 'skipOnError' => true, 'targetClass' => Campana::className(), 'targetAttribute' => ['campana_id_campana' => 'id_campana']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'persona_id_persona' => 'Nombre',
            'campana_id_campana' => 'Campana Id Campana',
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
    public function getCampanaIdCampana()
    {
        return $this->hasOne(Campana::className(), ['id_campana' => 'campana_id_campana']);
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
