<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
//use yii\bootstrap\Html;
use yii\bootstrap\Button;
use yii\bootstrap\ButtonDropdown;
use yii\bootstrap\ActiveForm;
use kartik\dynagrid\DynaGrid;
use kartik\grid\GridView;
use app\models\Llamada;
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
$this->title = 'Lista de Llamadas';
$columns=[

    ['class'=>'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT],
    
      [
                'attribute' => 'persona_id_persona',
                'label' => 'Nombre',
                'value' => function($model){
                    return $model->personaIdPersona->nombre;
                },
            ],
      [
                'attribute' => 'persona_id_persona',
                'label' => 'Apellido',
                'value' => function($model){
                    return $model->personaIdPersona->apellido;
                },
            ],
      [
                'attribute' => 'persona_id_persona',
                'label' => 'Teléfono',
                'value' => function($model){
                    return $model->personaIdPersona->telefono;
                },
            ],
    [
        'attribute'=>'fecha',
        'pageSummary'=>'Page Total',
        'vAlign'=>'middle',
        'contentOptions'=>['style'=>'max-width: 100px;overflow: auto; word-wrap: break-word;']
    ],

    [
        'attribute'=>'hora',
        'pageSummary'=>'Page Total',
        'vAlign'=>'middle',
        'contentOptions'=>['style'=>'max-width: 300px;max-height: 150px;overflow: auto; word-wrap: break-word;white-space: nowrap;'],
    ],
    
    
    [
                'attribute' => 'ubicacion_id_ubicacion',
                'label' => 'Latitud',
                'value' => function($model){
                    return $model->ubicacionIdUbicacion->latitud;
                },
            ],
     [
                'attribute' => 'ubicacion_id_ubicacion',
                'label' => 'Longitud',
                'value' => function($model){
                    return $model->ubicacionIdUbicacion->longitud;
                },
            ],
   

    
  
   

   /* [
        'class'=>'kartik\grid\BooleanColumn',
        'attribute'=>'estado', 
        'vAlign'=>'middle',
    ],
*/
    [
        'class'=>'kartik\grid\ActionColumn',
        'dropdown'=>false,
        'template'=>'{localizar}',

        'buttons'=>[

            'localizar' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-map-marker"></span>', $url,

                               [  
                                   'title' => Yii::t('yii', 'Ubicación'),
                                    ]);
                                    
                               
            }

        ],
        /*'urlCreator'=>function($action, $model, $key, $index) { return '#'; },
        'viewOptions'=>['title'=>'ver', 'data-toggle'=>'tooltip'],
        'updateOptions'=>['title'=>'actualizar', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['title'=>'eliminar', 'data-toggle'=>'tooltip'], */
        'order'=>DynaGrid::ORDER_FIX_RIGHT
    ],

];
?>

<div class="persona-view">

    <?= DynaGrid::widget([
    'columns'=>$columns,
    'storage'=>DynaGrid::TYPE_COOKIE,
    'theme'=>'panel-info',
    'showPersonalize'=>true,
    'storage' => 'session',
    'gridOptions'=>[
        'dataProvider'=>$dataProvider,
        //'filterModel'=>$searchModel,
        'floatHeader'=>true,
        'pjax'=>true,
        'responsiveWrap'=>false,
        'panel'=>['heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-tasks"></i>&nbsp;Llamadas generadas a través de la Aplicación Móvil</h3>'],
    ],
    'options'=>['id'=>'dynagrid-1'] // a unique identifier is important
]) ?>


</div>
