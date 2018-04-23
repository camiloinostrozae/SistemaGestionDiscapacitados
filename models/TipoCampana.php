<?php

namespace app\models;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * This is the model class for table "tipo_campana".
 *
 * @property int $id_tipo_campana
 * @property string $tipo
 *
 * @property Campana[] $campanas
 */
class TipoCampana extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_campana';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo'], 'required'],
            [['tipo'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_tipo_campana' => 'Id Tipo Campana',
            'tipo' => 'Tipo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampanas()
    {
        return $this->hasMany(Campana::className(), ['id_tipo_campana' => 'id_tipo_campana']);
    }
    
    //Obtengo el tipo de campañas
    public static function getTipoCampana(){
        $data = ArrayHelper::map(TipoCampana::find()->all(),'id_tipo_campana','tipo');
                                
        return $data;
    }
}
