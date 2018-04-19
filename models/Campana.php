<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "campana".
 *
 * @property int $id_campana
 * @property string $titulo
 * @property string $contenido
 * @property string $fecha_publicacion
 * @property string $fecha_vencimiento
 * @property string $estado
 * @property int $id_tipo_campana
 *
 * @property TipoCampana $tipoCampana
 * @property InteractuarCampana[] $interactuarCampanas
 * @property Persona[] $personaIdPersonas
 */
class Campana extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'campana';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['titulo', 'contenido', 'fecha_publicacion', 'fecha_vencimiento', 'estado', 'id_tipo_campana'], 'required'],
            [['titulo', 'contenido'], 'string'],
            [['fecha_publicacion', 'fecha_vencimiento'], 'safe'],
            [['id_tipo_campana'], 'integer'],
            [['estado'], 'string', 'max' => 10],
            [['id_tipo_campana'], 'exist', 'skipOnError' => true, 'targetClass' => TipoCampana::className(), 'targetAttribute' => ['id_tipo_campana' => 'id_tipo_campana']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_campana' => 'Id Campana',
            'titulo' => 'Titulo',
            'contenido' => 'Contenido',
            'fecha_publicacion' => 'Fecha Publicacion',
            'fecha_vencimiento' => 'Fecha Vencimiento',
            'estado' => 'Estado',
            'id_tipo_campana' => 'Id Tipo Campana',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoCampana()
    {
        return $this->hasOne(TipoCampana::className(), ['id_tipo_campana' => 'id_tipo_campana']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInteractuarCampanas()
    {
        return $this->hasMany(InteractuarCampana::className(), ['campana_id_campana' => 'id_campana']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonaIdPersonas()
    {
        return $this->hasMany(Persona::className(), ['id_persona' => 'persona_id_persona'])->viaTable('interactuar_campana', ['campana_id_campana' => 'id_campana']);
    }
}
