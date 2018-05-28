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
$this->title = 'Listar Acceso a Campañas';
$columns=[

    ['class'=>'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT],
    [
        'attribute'=>'titulo',
        'pageSummary'=>'Page Total',
        'vAlign'=>'middle',
        'order'=>DynaGrid::ORDER_FIX_LEFT,
        'contentOptions'=>['style'=>'max-width: 100px;overflow: auto; word-wrap: break-word;']
    ],
/**
    [
        'attribute'=>'contenido',
        'pageSummary'=>'Page Total',
        'vAlign'=>'middle',
        'order'=>DynaGrid::ORDER_FIX_LEFT,
        'contentOptions'=>['style'=>'max-width: 300px;max-height: 150px;overflow: auto; word-wrap: break-word;white-space: nowrap;'],
    ],*/
    
      [
                'attribute' => 'id_tipo_campana',
                'value' => function($model){
                    return $model->tipoCampana->tipo;
                },
        ],


    [
        'attribute'=>'fecha_publicacion',
        'filterType'=>GridView::FILTER_DATE,
        'format'=>'raw',
        'width'=>'170px',
        'contentOptions'=>['style'=>'max-width: 100px;'],
        'filterWidgetOptions'=>[
            'pluginOptions'=>['format'=>'dd-mm-yyyy']
        ],
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
        'template'=>'{user}',

        'buttons'=>[

            'user' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-user"></span>', $url,

                               [  
                                   'title' => Yii::t('yii', 'Usuarios'),
                                   'data-method'=>'post'
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

<div class="campana-view">

    <?= DynaGrid::widget([
    'columns'=>$columns,
    'storage'=>DynaGrid::TYPE_COOKIE,
    'theme'=>'panel-info',
    'showPersonalize'=>true,
    'storage' => 'session',
    'gridOptions'=>[
        'dataProvider'=>$dataProvider,
        'filterModel'=>$searchModel,
        'floatHeader'=>true,
        'pjax'=>true,
        'responsiveWrap'=>false,
        'panel'=>['heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-tasks"></i>&nbsp;Campañas</h3>'],
    ],
    'options'=>['id'=>'dynagrid-1'] // a unique identifier is important
]) ?>


</div>
