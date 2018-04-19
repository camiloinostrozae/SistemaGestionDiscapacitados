<?php

namespace app\controllers;

class LlamadaController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
