<?php
namespace app\controllers;
use yii\web\Response;
use yii\rest\ActiveController;
use app\models\Persona;
use Yii;
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
           return array('codigo'=>200,'estado'=>true,'mensaje'=>'Usuario válido','nombre'=>$persona->nombre,
                        'apellido'=>$persona->apellido,'auth_key'=>$persona->auth_key);
       }else{
           
           return array('codigo'=>401,'estado'=>false,'mensaje'=>'El usuario no existe');
       }
   }
    
    //Servicio Web para el registro de usuarios
    public function actionCreatePersona(){
        $persona = new Persona();
        $persona->attributes = Yii::$app->request->post();
        $persona->auth_key = $persona->generateAuthKey();
        $persona->comuna_id_comuna = 182;
        $persona->rut="00000000-0";
		$persona->rol_id_rol = 3;
        if($persona->validate()){
			$datos = array( 'nombre'=>$persona->nombre,'apellido'=>$persona->apellido,
                        'telefono'=>$persona->telefono,'email'=>$persona->email,'contrasena'=>$persona->contrasena,
                        'fecha_nacimiento'=>$persona->fecha_nacimiento,'sexo'=>$persona->sexo);
            if($persona->save());
            return array('codigo'=>200,'estado'=>true,'persona'=>$datos);
        }else{
            return array('codigo'=>401,'estado'=>false);
            //'mensaje'=>'Error, usuario no se pudo registrar'
        }
    }
}