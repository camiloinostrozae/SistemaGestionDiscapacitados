<?php

namespace app\controllers;
use Yii;
use app\models\Tramite;
use app\models\TramiteSearch;
use app\models\InteractuarTramiteSearch;
use yii\filters\VerbFilter;
class TramiteController extends \yii\web\Controller
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
               'only' => ['index','update','delete','view','listar','listartramites','user'],
               //Para los ussuario autenticados como super Admin
               'rules' => [
                   [
                     'allow' =>true,
                     'actions' =>['index','update','delete','view','listar','listartramites','user'],
                     'roles' =>['@'],
                         'matchCallback' => function ($rule,$action){
                                                return \app\models\User::isAdmin(Yii::$app->user->identity->id);
                                         }
                   ],
                
            
               ],
            
             ],
            
        ];
    }
     public function actionIndex() {
        $model = new Tramite();
        $model->fecha_publicacion=date('Y-m-d');
        $model->estado="Vigente";
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // datos validos recibidos
            Yii::$app->getSession()->setFlash('success', [

                'message' => 'Trámite Ingresado Exitosamente',
            ]);

            $searchModel = new TramiteSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->query->orderBy(['id_tramite'=>SORT_DESC])->all();
            return $this->render('listar',  [
                'model'=>$model,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            // o se ha solicitado la pagina inicial o bien hay un error de validacion
            return $this->render('create', ['model' => $model]);
        }
    }
    
     public function actionListar(){
        $searchModel = new TramiteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
         $dataProvider->query->orderBy(['id_tramite'=>SORT_DESC])->all();
        return $this->render('listar', [

            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }
    
    public function actionView($id){


        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }
    
     public function actionDelete($id){

        Yii::$app->getSession()->setFlash('error', [

            'message' => 'Trámite Eliminado Exitosamente',
        ]);
        $this->findModel($id)->delete();
        return $this->redirect(['listar']);
    }
    
      public function actionListartramites(){
        $searchModel = new TramiteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
          $dataProvider->query->orderBy(['id_tramite'=>SORT_DESC])->all();
        return $this->render('listartramites', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }
    
     public function actionUser($id){
         $model = $this->findModel($id);
        $searchModel = new InteractuarTramiteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere('tramite_id_tramite = '.$id);
         $dataProvider->query->orderBy(['fecha'=>SORT_DESC,'hora'=>SORT_DESC])->all();
        return $this->render('listaraccesotramites', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);

    }
    
    public function actionUpdate($id){

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->getSession()->setFlash('info', [

                'message' => 'Trámite Actualizado Exitosamente',
            ]);
            return $this->redirect(['listar', 'id' => $model->id_tramite]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    
     protected function findModel($id) {
        if (($model = Tramite::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
