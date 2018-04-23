<?php

namespace app\controllers;
use Yii;
use app\models\Tramite;
use app\models\TramiteSearch;

class TramiteController extends \yii\web\Controller
{
    /**
    public function actionIndex()
    {
        return $this->render('index');
    }**/
    
     public function actionIndex() {
        $model = new Tramite();
        $model->fecha_publicacion=date('Y-m-d');
        $model->estado="Vigente";
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // datos validos recibidos
            Yii::$app->getSession()->setFlash('success', [

                'message' => 'Trámite ingresado exitosamente',
            ]);

            $searchModel = new TramiteSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
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

            'message' => 'Trámite eliminado exitosamente',
        ]);
        $this->findModel($id)->delete();
        return $this->redirect(['listar']);
    }
    
    public function actionUpdate($id){

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->getSession()->setFlash('success', [

                'message' => 'Trámite actualizado exitosamente',
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
