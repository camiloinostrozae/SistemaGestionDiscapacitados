<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
//use yii\bootstrap\Html;
use yii\bootstrap\Button;
use yii\bootstrap\ButtonDropdown;
use yii\bootstrap\ActiveForm;
use kartik\dynagrid\DynaGrid;
use kartik\grid\GridView;
use app\models\Campana;
use kartik\growl\Growl;
use kartik\alert\AlertBlock;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $model app\models\Campana */
?>



<?php AlertBlock::widget([
    'useSessionFlash' => true,
    'type' => AlertBlock::TYPE_GROWL
]);
?>

<?php AlertBlock::widget([
    'useSessionFlash' => true,
    'type' => AlertBlock::TYPE_GROWL
]);
?>

<?php
$this->title = 'Lista de Campañas ';
$columns=[

    ['class'=>'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT],
    
     [
                'attribute' => 'campana_id_campana',
                'label' => 'Título',
                'value' => function($model){
                    return $model->campanaIdCampana->titulo;
                },
            ],
    [
                'attribute' => 'campana_id_campana',
                'label' => 'Fecha de Publicación',
                'value' => function($model){
                    return $model->campanaIdCampana->fecha_publicacion;
                },
            ],
 
    [
                'attribute' => 'campana_id_campana',
                'label' => 'Estado',
                'value' => function($model){
                    return $model->campanaIdCampana->estado;
                },
            ],

     [
                'attribute' => 'campana_id_campana',
                'label' => 'Tipo de Campaña',
                'value' => function($model){
                    return $model->tipocampanaIdTipocampana->tipo;
                },
            ],

     [
                'attribute' => 'fecha',
                
            ],
      [
                'attribute' => 'hora',
            ],
      
     



];
?>

<div class="campana-view">

    <?= DynaGrid::widget([
    'columns'=>$columns,
    'storage'=>DynaGrid::TYPE_COOKIE,
    'theme'=>'panel-info',
    'showPersonalize'=>true,
    'showPersonalize'=>true,
    'storage' => 'session',
    'gridOptions'=>[
        'dataProvider'=>$dataProvider,
        //'filterModel'=>$searchModel,
        'floatHeader'=>true,
        'pjax'=>true,
        'responsiveWrap'=>false,
'panel'=>['heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-tasks"></i>&nbsp;'.'Campañas escuchadas por '.$model->nombre.' '.$model->apellido.'</h3>'],
    ],
    'options'=>['id'=>'dynagrid-1'] // a unique identifier is important
]) ?>

</div>
