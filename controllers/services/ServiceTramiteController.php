<?php
namespace app\controllers\services;
use yii\web\Response;
use yii\rest\ActiveController;
use app\models\Tramite;
use Yii;
class ServiceTramiteController extends ActiveController{

    public $modelClass = 'app\models\Tramite';
    
    
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
    
    
    public function actionListarTramites(){
        
       return Tramite::serviceListarTramites();
    }
    
}