<?php
namespace app\controllers\services;
use yii\web\Response;
use yii\rest\ActiveController;
use app\models\Region;
use Yii;
class ServiceRegionController extends ActiveController{

    public $modelClass = 'app\models\Region';
    
    
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
    
    
    public function actionGetRegiones(){
        $region = Region::find()->all() ;
        if($region){
            return $region;
        }else{
           return false;
        }
    }
    
    public function actionGetRegion($id){
        $region = Region::findOne(['id_region'=>$id]);
        if($region){
            return $region;
        }else{
           return false;
        }
    }
    
    
}