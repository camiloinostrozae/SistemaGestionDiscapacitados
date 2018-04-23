<?php

use yii\helpers\Html;
//use kartik\detail\DetailView;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Vendedor


 /* <?= DetailView::widget([

        'attributes' => [
            'id_campana',
            'titulo',
            'contenido',
            'fecha_publicacion',
            'fecha_vencimiento',
            'estado',
        ],
    ]) ?>*/


?>


<?php 
/*
$atributos = [
    [
        'group'=>true,
        'label'=>'Acerca de la campaña',
        'rowOptions'=>['class'=>'info']
    ],

    [
        'columns' => [
            [
                'attribute'=>'id_campana', 
                'label'=>'Campaña número',
                'displayOnly'=>true,
                'valueColOptions'=>['style'=>'width:30%']
            ],
            [
                'attribute'=>'estado', 
                'format'=>'raw', 
                'valueColOptions'=>['style'=>'width:30%'], 
                'displayOnly'=>true
            ],
        ],
    ],

    [
        'columns' => [
            [
                'attribute'=>'fecha_publicacion',
                'valueColOptions'=>['style'=>'width:30%'],
            ],
            [
                'attribute'=>'fecha_vencimiento', 
                'format'=>'raw', 
                'valueColOptions'=>['style'=>'width:30%'], 
            ],
        ],
    ],

    [
        'columns' => [
            [
                'attribute'=>'titulo',
                'valueColOptions'=>['style'=>'width:30%'],
            ],
            [
                'attribute'=>'id_tipo_campana', 
                'format'=>'raw', 
                'valueColOptions'=>['style'=>'width:30%'], 
            ],
        ],
    ],

    
   ['columns'=> [[
        'attribute'=>'contenido',
        'format'=>'raw',
        'value'=>'<span class="text-justify"><em>'.$model->contenido.'</em></span>',
        'type'=>DetailView::INPUT_TEXTAREA, 
        'options'=>['rows'=>5]
   ] ],], 
   



]
*/

?>
<div class="modal-body">
    
    <?php
/*
    <?= DetailView::widget([

    'model'=>$model,
    'condensed'=>true,
    'mode'=>'view',
    'hover' => 'true',

    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=>'Campaña # ' . $model->id_campana,
        'type'=>DetailView::TYPE_INFO,
    ],
    'attributes' => $atributos
*/ ?>
    
    
     <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'titulo',
            [
            'attribute'=>'contenido',
                'value'=>'<span class="text-justify"><em>'.$model->contenido.'</em></span>',
                'options'=>['row'=>5],
                'contentOptions'=>['style'=>'max-width: 300px;max-height: 500px;overflow: auto; word-wrap: break-word;white-space: nowrap;'],
                ],
            'fecha_publicacion',
            
           
        ],
    
]) ?>



</div>
