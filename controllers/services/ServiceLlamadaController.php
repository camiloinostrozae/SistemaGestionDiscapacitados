<?php
namespace app\controllers\services;
use yii\web\Response;
use yii\rest\ActiveController;
use app\models\Llamada;
use app\models\Persona;
use app\models\Ubicacion;
use Yii;

class ServiceLlamadaController extends ActiveController{

    public $modelClass = 'app\models\Llamada';

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

    public function actionGuardarLlamada(){

        $persona = new Persona();
        /*Lo pasado a través de la solicitud POST lo guardamos
          en los atributos del modelo persona, para posteriormente
          obtener el authkey*/
        $persona->attributes = Yii::$app->request->post();
        $auth_key = $persona->auth_key;
        //Obtenemos el ID de la persona en base al auth_key
        $id_persona = Persona::getUserId($auth_key);
        if(!$id_persona){
            return array('codigo'=>401,'estado'=>false);
        }

        $llamada = new Llamada();
        //Almacenamos los pasado a través del POST en el modelo Llamada
        $llamada->attributes = Yii::$app->request->post();
        //Se obtiene la fecha actual
        $llamada->fecha = date('Y-m-d');
        //Se establece la zona horaria de Chile
        date_default_timezone_set('America/Santiago');
        $llamada->hora = date('H:i:s');
        /*La id de persona obtenida gracias al authkey, se la asignamos al id
          persona de las instacioación de la llamada.
         */
        $llamada->persona_id_persona = $id_persona->id_persona;
        /*Instaciamos una variable para obtener los atributos 
          del modelo Ubicación y así recoger los datos pasados
          por post e insertarlos en la BD.
          */ 
        
        //Se define un id para asignarle posteriormente el id de la ubicación
        $id_ubicacion;
        $ubicacion = new Ubicacion;
        $ubicacion->attributes = Yii::$app->request->post();
        
        $latitud = $ubicacion->latitud;
        $longitud = $ubicacion->longitud;
        //Insertamos los datos obtenidos relacionados con la ubicación en BD
        if($ubicacion->validate() && $ubicacion->save()){
            $id_ubicacion = $ubicacion->id_ubicacion;
        }else{
            return array('codigo'=>401,'estado'=>false);
        }
        
        $llamada->ubicacion_id_ubicacion = $id_ubicacion;
        if($llamada->validate() && $llamada->save()){
             return array('codigo'=>200,'estado'=>true);
        }else{
             return array('codigo'=>1,'estado'=>false , "mensaje"=>$llamada->getErrors());
        }
            

    }
}