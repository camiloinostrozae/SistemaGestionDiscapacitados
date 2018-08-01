<?php
namespace app\controllers\services;
use yii\web\Response;
use yii\rest\ActiveController;
use app\models\Comuna;
use Yii;
class ServiceComunaController extends ActiveController{

    public $modelClass = 'app\models\Comuna';
    
    
    public function behaviors(){
         $behaviors = parent::behaviors();
        //Filtro para responder en formato JSON
        $behaviors['contentNegotiator'] = [
            'class' => 'yii\filters\ContentNegotiator',
            'formats' => [
                'application/json' => Response::FORMAT_JSON,

            ]
        ];

        return $behaviors;
    }
    
    public function actionListarComunas(){
          $comuna = Comuna::find()->select('nombreComuna')->joinWith('regionIdRegion')->all();
        if($comuna){ 
            return $comuna;
        }else{
            return false;
        }
    }
    
    public function actionGetComuna($region_id_region){
        $comuna = Comuna::find()->where(['region_id_region'=>$region_id_region])->asArray()->all();
        if($comuna){
            return $comuna;
        }else{
            return false;
        }
    }
    
    
}