<?php
namespace app\controllers\services;
use yii\web\Response;
use yii\rest\ActiveController;
use app\models\Campana;
use Yii;
class ServiceCampanaController extends ActiveController{

    public $modelClass = 'app\models\Campana';
    
    
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
    
    
    public function actionListarCampanas(){
        $campana = Campana::serviceListarCampanas();
        return $campana;
        
    }
    
}