<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_tramite".
 *
 * @property int $id_tipo_tramite
 * @property string $tipo
 *
 * @property Tramite[] $tramites
 */
class TipoTramite extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_tramite';
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
            'id_tipo_tramite' => 'Id Tipo Tramite',
            'tipo' => 'Tipo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTramites()
    {
        return $this->hasMany(Tramite::className(), ['id_tipo_tramite' => 'id_tipo_tramite']);
    }
}
