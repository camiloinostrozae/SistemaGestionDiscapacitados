<?php
namespace app\controllers\services;
use yii\web\Response;
use yii\rest\ActiveController;
use app\models\InteractuarCampana;
use app\models\Persona;
use Yii;

class ServiceInteractuarCampanaController extends ActiveController{

    public $modelClass = 'app\models\InteractuarCampana';


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


    public function actionRegistrarInteraccionCampana($auth_key){
        $id_persona = Persona::getUserId($auth_key);
        if(!$id_persona){
            return array('codigo'=>401,'estado'=>false);
        }
        $interactuar_campana = new InteractuarCampana();
        $interactuar_campana->attributes = Yii::$app->request->post();
        //Obtengo la fecha actual
        $interactuar_campana->fecha = date('Y-m-d');
        //Obtengo la hora actual
        date_default_timezone_set('America/Santiago');
        $interactuar_campana->hora = date('H:i:s');
        //En base al ID de persona obtenido anteriormente se lo asigno al atributo persona_id_persona
        $interactuar_campana->persona_id_persona = $id_persona->id_persona;
        if($interactuar_campana->validate() && $interactuar_campana->save()){
            return array('codigo'=>200, 'estado'=>true);
        }else{
            return array('codigo'=>401,'estado'=>false, "error"=>$interactuar_campana->getErrors());
        }
    }


}