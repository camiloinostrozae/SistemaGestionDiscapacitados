<?php

namespace app\controllers;
use Yii;
use app\models\Campana;
use app\models\CampanaSearch;
use app\models\InteractuarCampanaSearch;
use yii\filters\VerbFilter;
class CampanaController extends \yii\web\Controller{
    
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
               'only' => ['index','update','delete','view','listar','listarcampanas','user'],
               //Para los ussuario autenticados como super Admin
               'rules' => [
                   [
                     'allow' =>true,
                     'actions' =>['index','update','delete','view','listar','listarcampanas','user'],
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
        $model = new Campana();
        $model->fecha_publicacion=date('Y-m-d');
        $model->estado="Vigente";
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // datos validos recibidos
            Yii::$app->getSession()->setFlash('success', [

                'message' => 'Campaña Ingresada Exitosamente',
            ]);

            $searchModel = new CampanaSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->query->orderBy(['fecha_publicacion'=>SORT_DESC])->all();
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
        $searchModel = new CampanaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->orderBy(['fecha_publicacion'=>SORT_DESC])->all();
        return $this->render('listar', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }
    
    public function actionListarcampanas(){
        $searchModel = new CampanaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->orderBy(['fecha_publicacion'=>SORT_DESC])->all();
        return $this->render('listarcampanas', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }
    public function actionUser($id){
        $model = $this->findModel($id);
        $searchModel = new InteractuarCampanaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere('campana_id_campana = '.$id);
        return $this->render('listaraccesocampanas', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);

    }

    public function actionView($id){


        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionDelete($id){

        Yii::$app->getSession()->setFlash('error', [

            'message' => 'Campaña Eliminada Exitosamente',
        ]);
        $this->findModel($id)->delete();
        return $this->redirect(['listar']);
    }

    public function actionUpdate($id){

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->getSession()->setFlash('info', [

                'message' => 'Campaña Actualizada Exitosamente',
            ]);
            return $this->redirect(['listar', 'id' => $model->id_campana]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    protected function findModel($id) {
        if (($model = Campana::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
