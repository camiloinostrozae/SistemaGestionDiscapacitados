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

}
