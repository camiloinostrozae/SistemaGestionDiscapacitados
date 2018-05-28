<?php

namespace app\controllers\services;
use yii\web\Response;
use yii\rest\ActiveController;
use app\models\InteractuarTramite;
use app\models\Persona;
use Yii;

class ServiceInteractuarTramiteController extends ActiveController{

    public $modelClass = 'app\models\InteractuarTramite';

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


    //Registrar la interacción de un usuario con una campana
    public function actionRegistrarInteraccionTramite(){
        //Obtenemos la auth_key de la persona y en base a ello obtenemos su ID
        $persona = new Persona();
        $persona->attributes = Yii::$app->request->post();
        $auth_key = $persona->auth_key;
        
        $id_persona = Persona::getUserId($auth_key);
        if(!$id_persona){
            return array('codigo'=>401,'estado'=>false);
        }
        $interactuar_tramite = new InteractuarTramite();
        $interactuar_tramite->attributes = Yii::$app->request->post();
        //Se obtiene la fecha actual
        $interactuar_tramite->fecha = date('Y-m-d');
        //Se establece la zona horaria de Chile
        date_default_timezone_set('America/Santiago');
        $interactuar_tramite->hora = date('H:i:s');
        $interactuar_tramite->persona_id_persona=$id_persona->id_persona;
        if($interactuar_tramite->validate() && $interactuar_tramite->save()){
            return array('codigo'=>200, 'estado'=>true);
        }else{
            return array('codigo'=>401,'estado'=>false);
        }

    }
}