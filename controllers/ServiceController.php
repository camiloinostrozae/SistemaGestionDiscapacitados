<?php
namespace app\controllers;
use yii\web\Response;
use yii\rest\ActiveController;
use app\models\Persona;
use app\models\Comuna;
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
        
        $rut = Persona::formatearRut($user);
        if(!Persona::isValidRut($rut)){
            return array('codigo'=>1,'estado'=>false, 'mensaje'=>'Rut no se encuentra registrado');
        }
        $persona = Persona::findOne(['rut'=>$rut,'contrasena'=>$password]);
        $respuesta = array();
        if($persona){
            return array('codigo'=>200,'estado'=>true,'mensaje'=>'Usuario válido','nombre'=>$persona->nombre,
                         'apellido'=>$persona->apellido,'rut'=>$persona->rut,'contrasena'=>$persona->contrasena,'auth_key'=>$persona->auth_key,
                         "rol"=>$persona->rol_id_rol);
        }else{

            return array('codigo'=>401,'estado'=>false,'mensaje'=>'El usuario no existe');
        }
    }

    //Servicio Web para el registro de usuarios
    public function actionCreatePersona(){
        $persona = new Persona();
        $persona->attributes = Yii::$app->request->post();
        $persona->auth_key = $persona->generateAuthKey();
        $persona->rol_id_rol = 3;
        $persona->rut = Persona::formatearRut($persona->rut);
        $rutYaRegistrado = Persona::findOne(['rut'=>$persona->rut]);
        if(!empty($rutYaRegistrado)){
            return array('codigo'=>001, 'estado'=>false);
        } 
        
        //Se busca que si existe una persona con el mail ingresado en el formulario
        $emailRegistrado = Persona::findOne(['email'=>$persona->email]);
        if(Persona::findByCorreo($emailRegistrado)){
            return array('codigo'=>2, 'estado'=>false);
        }
        
        $telefonoRegistrado = Persona::findOne(['telefono'=>$persona->telefono]);
        if(Persona::findByTelefono($telefonoRegistrado)){
            return array('codigo'=>3, 'estado'=>false);
        }

        if($persona->validate()){
            $datos = array( 'nombre'=>$persona->nombre,'apellido'=>$persona->apellido,'rut'=>$persona->rut, 
                            'contrasena'=>$persona->contrasena,'auth_key'=>$persona->auth_key);
            if($persona->save());
            return array('codigo'=>200,'estado'=>true,'persona'=>$datos);
        }else{
            return array('codigo'=>401,'estado'=>false ,'mensaje'=>$persona->getErrors());
            //'mensaje'=>'Error, usuario no se pudo registrar'
        }

    }
}