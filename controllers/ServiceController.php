<?php
namespace app\controllers;
use yii\web\Response;
use yii\rest\ActiveController;
use app\models\Persona;
class ServiceController extends ActiveController{

    public $modelClass = 'app\models\Persona';


    //Se define en el comportamiento del controller que pueda responder en formato JSON
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
    
    //Servicio Web para el Login
   public function actionLogin($user,$password){
       $persona = Persona::findOne(['email'=>$user,'contrasena'=>$password]);
	   $respuesta = array();
       if($persona){
		   $respuesta["mensaje"] = true;
           return $respuesta;
       }else{
           $respuesta["mensaje"] = false;
           return $respuesta;
       }
   }
}