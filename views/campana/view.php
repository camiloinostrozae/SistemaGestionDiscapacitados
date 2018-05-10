<?php

use yii\helpers\Html;
use kartik\detail\DetailView;


?>


<?php 

$atributos = [
    [
        'group'=>true,
        'label'=>$model->titulo,
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
           
        ],
    ],


   ['columns'=> [[
        'attribute'=>'contenido',
        'format'=>'raw',
        'value'=>'<span class="text-justify"><em>'.$model->contenido.'</em></span>',
        'type'=>DetailView::INPUT_TEXTAREA, 
       'valueColOptions'=>['style'=>'max-width: 300px;max-height: 1000px;overflow: auto; word-wrap: break-word;white-space: normal;text-align: justify;margin: 0 0 10px;'],
       
   ] ],], 




]


?>
<div class="modal-body">

    
    <?= DetailView::widget([

    'model'=>$model,
    'condensed'=>true,
    'mode'=>'view',
    'hover' => 'true',
    

    'mode'=>DetailView::MODE_VIEW,
    
    'attributes' => $atributos




]) ?>



</div>
