<?php

namespace app\models;
use yii\helpers\ArrayHelper;

use Yii;

/**
 * This is the model class for table "comuna".
 *
 * @property int $id_comuna
 * @property string $nombre
 * @property int $region_id_region
 *
 * @property Region $regionIdRegion
 * @property Persona[] $personas
 */
class Comuna extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comuna';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'region_id_region'], 'required'],
            [['region_id_region'], 'integer'],
            [['nombre'], 'string', 'max' => 100],
            [['region_id_region'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['region_id_region' => 'id_region']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_comuna' => 'Id Comuna',
            'nombre' => 'Nombre',
            'region_id_region' => 'Region Id Region',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegionIdRegion()
    {
        return $this->hasOne(Region::className(), ['id_region' => 'region_id_region']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonas()
    {
        return $this->hasMany(Persona::className(), ['comuna_id_comuna' => 'id_comuna']);
    }
    
       public static function getComunas(){
        return ArrayHelper::map(Comuna::find()->all(),'id_comuna','nombre');
    }
    
    public static function  getIdComuna($comuna){
        return self::find()->select('id_comuna')->where(['nombre'=>$comuna])->one() ;
    }
}
