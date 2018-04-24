<?php

namespace app\controllers;
use Yii;
use app\models\Campana;
use app\models\CampanaSearch;
class CampanaController extends \yii\web\Controller{

    public function actionIndex() {
        $model = new Campana();
        $model->fecha_publicacion=date('Y-m-d');
        $model->estado="Vigente";
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // datos validos recibidos
            Yii::$app->getSession()->setFlash('success', [

                'message' => 'Campaña ingresada exitosamente',
            ]);

            $searchModel = new CampanaSearch();
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
        $searchModel = new CampanaSearch();
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

            'message' => 'Campaña eliminada exitosamente',
        ]);
        $this->findModel($id)->delete();
        return $this->redirect(['listar']);
    }

    public function actionUpdate($id){

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->getSession()->setFlash('success', [

                'message' => 'Campaña actualizada exitosamente',
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
