<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "persona".
 *
 * @property int $id_persona
 * @property string $nombre
 * @property string $apellido
 * @property string $rut
 * @property string $fecha_nacimiento
 * @property string $email
 * @property string $telefono
 * @property string $sexo
 * @property string $contrasena
 * @property int $comuna_id_comuna
 * @property int $rol_id_rol
 *
 * @property InteractuarCampana[] $interactuarCampanas
 * @property Campana[] $campanaIdCampanas
 * @property InteractuarTramite[] $interactuarTramites
 * @property Tramite[] $tramiteIdTramites
 * @property Llamada[] $llamadas
 * @property Comuna $comunaIdComuna
 * @property Rol $rolIdRol
 */
class Persona extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'persona';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'apellido', 'rut', 'fecha_nacimiento', 'email', 'telefono', 'sexo', 'contrasena', 'comuna_id_comuna', 'rol_id_rol'], 'required'],
            [['fecha_nacimiento'], 'safe'],
            [['comuna_id_comuna', 'rol_id_rol'], 'integer'],
            [['nombre', 'contrasena'], 'string', 'max' => 45],
            [['apellido', 'email'], 'string', 'max' => 100],
            [['rut', 'telefono'], 'string', 'max' => 20],
            [['sexo'], 'string', 'max' => 10],
            [['comuna_id_comuna'], 'exist', 'skipOnError' => true, 'targetClass' => Comuna::className(), 'targetAttribute' => ['comuna_id_comuna' => 'id_comuna']],
            [['rol_id_rol'], 'exist', 'skipOnError' => true, 'targetClass' => Rol::className(), 'targetAttribute' => ['rol_id_rol' => 'id_rol']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_persona' => 'Id Persona',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'rut' => 'Rut',
            'fecha_nacimiento' => 'Fecha Nacimiento',
            'email' => 'Email',
            'telefono' => 'Telefono',
            'sexo' => 'Sexo',
            'contrasena' => 'Contrasena',
            'comuna_id_comuna' => 'Comuna Id Comuna',
            'rol_id_rol' => 'Rol Id Rol',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInteractuarCampanas()
    {
        return $this->hasMany(InteractuarCampana::className(), ['persona_id_persona' => 'id_persona']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampanaIdCampanas()
    {
        return $this->hasMany(Campana::className(), ['id_campana' => 'campana_id_campana'])->viaTable('interactuar_campana', ['persona_id_persona' => 'id_persona']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInteractuarTramites()
    {
        return $this->hasMany(InteractuarTramite::className(), ['persona_id_persona' => 'id_persona']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTramiteIdTramites()
    {
        return $this->hasMany(Tramite::className(), ['id_tramite' => 'tramite_id_tramite'])->viaTable('interactuar_tramite', ['persona_id_persona' => 'id_persona']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLlamadas()
    {
        return $this->hasMany(Llamada::className(), ['persona_id_persona' => 'id_persona']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComunaIdComuna()
    {
        return $this->hasOne(Comuna::className(), ['id_comuna' => 'comuna_id_comuna']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRolIdRol()
    {
        return $this->hasOne(Rol::className(), ['id_rol' => 'rol_id_rol']);
    }
}