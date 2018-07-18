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
            'titulo' => 'Título',
            'contenido' => 'Contenido',
            'fecha_publicacion' => 'Fecha Publicación',
            'fecha_vencimiento' => 'Fecha Término',
            'estado' => 'Estado',
            'id_tipo_campana' => 'Tipo de Campaña',
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




    //Función para formatear la fecha ingresada en el form y se inserte en el formato correcto

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
    
    
    public function serviceListarCampanas(){
        /* $campana = Campana::find()->joinWith('tipoCampana')->all();
        if($campana){
            return $campana;
        }else{
            return false;
        }*/
        
        $campanas = (new \yii\db\Query())
            ->from('campana')
            ->select('id_campana, titulo, contenido,fecha_publicacion, fecha_vencimiento, tipo')
            ->innerJoin('tipo_campana','campana.id_tipo_campana = tipo_campana.id_tipo_campana')
            ->where(['estado' => 'vigente'])
            ->orderBy('id_campana')
             ->all();
        return $campanas;
        
    }
    
    
    public function validarFecha($attribute,$params)
    {
        $fechaT=$this->fecha_vencimiento;
   if (date("Y-m-d",strtotime($fechaT)) <= date("Y-m-d"))
      $this->addError('fecha_vencimiento','Fecha de Término debe ser posterior a la Fecha actual');
    }
}
