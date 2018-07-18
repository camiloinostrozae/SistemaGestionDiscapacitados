<?php

namespace app\controllers;

use Yii;
use app\models\Llamada;
use app\models\LlamadaSearch;
use app\models\Ubicacion;
use app\models\Persona;
use yii\filters\VerbFilter;

class LlamadaController extends \yii\web\Controller
{
    
     public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            
             /** Para los permisos  se hace lo siguiente*/ 
            'access' => [
               'class' => \yii\filters\AccessControl::className(),
               'only' => ['index','listar','localizar'],
               //Para los ussuario autenticados como super Admin
               'rules' => [
                   [
                     'allow' =>true,
                     'actions' =>['index','listar','localizar'],
                     'roles' =>['@'],
                    'matchCallback' => function ($rule,$action){
                                                return \app\models\User::isCipol(Yii::$app->user->identity->id);
                                         }
                   ],
                
            
               ],
            
             ],
            
        ];
    }
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    
     public function actionListar(){
        $searchModel = new LlamadaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->orderBy(['fecha'=>SORT_DESC,'hora'=>SORT_DESC])->all();
        return $this->render('listar', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }
    
     public function actionLocalizar($id){
         
        $model = $this->findModel($id);
         
        $id_ubicacion = $model->ubicacion_id_ubicacion;
        $id_persona = $model->persona_id_persona; 
         
        $modelUbicacion = $this->findModelUbicacion($id_ubicacion); 
        $modelPersona =  $this->findModelPersona($id_persona); 
         
        //$latitud = $modelUbicacion->latitud;
        // $longitud = $modelUbicacion->longitud;
        
        return $this->render('localizar',[
            'modelU' => $modelUbicacion,
            'modelP' => $modelPersona,
        ]);

    }
    
     protected function findModel($id) {
        if (($model = Llamada::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
      protected function findModelUbicacion($id) {
        if (($model = Ubicacion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
       protected function findModelPersona($id) {
        if (($model = Persona::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
