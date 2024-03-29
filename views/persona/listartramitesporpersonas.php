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
$this->title = 'Lista de Trámites ';
$columns=[

    ['class'=>'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT],
    
    [
                'attribute' => 'titulo',
                'label' => 'Título',
                'value' => 'tramiteIdTramite.titulo'
            ],
    [
                'attribute' => 'fecha_publicacion',
                'filterType'=>GridView::FILTER_DATE,
                 'format'=>['date', 'php:d-m-Y'],
                'label' => 'Fecha de Publicación',
                'value' => 'tramiteIdTramite.fecha_publicacion',
                'filterWidgetOptions'=>[
                  'pluginOptions'=>['format'=>'yyyy-mm-dd']
        ],
            ],
 
   [
                'attribute' => 'estado',
                'label' => 'Estado',
                'value' => 'tramiteIdTramite.estado'
            ],

     [
                'attribute' => 'tramite_id_tramite',
                'label' => 'Tipo del Trámite',
                'value' => function($model){
                    return $model->tipotramiteIdTipotramite->tipo;
                },
            ],

     [
                'attribute' => 'fecha',
                'filterType'=>GridView::FILTER_DATE,
                 'format'=>['date', 'php:d-m-Y'],
                    'filterWidgetOptions'=>[
                  'pluginOptions'=>['format'=>'yyyy-mm-dd']
        ],
                
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
        'filterModel'=>$searchModel,
        'floatHeader'=>true,
        'pjax'=>true,
        'responsiveWrap'=>false,
'panel'=>['heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-tasks"></i>&nbsp;'.'Trámites escuchados por '.$model->nombre.' '.$model->apellido.'</h3>'],
    'toolbar' =>  ['{toggleData}',],
    ],
    'options'=>['id'=>'dynagrid-1'] // a unique identifier is important
]) ?>

</div>
