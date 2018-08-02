<?php


namespace app\controllers;

use yii\web\Controller;
use app\models\HtmlHelpers;
use app\models\Comuna;

class DependentDropdownController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

    public function actionComuna($id){
        echo HtmlHelpers::dropDownList(Comuna::className(), 'region_id_region', $id, 'id_comuna', 'nombreComuna');
    }

    
}
