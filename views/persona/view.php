<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
?>


<?php 

$atributos = [
    [
        'group'=>true,
        'label'=>'Información de la Persona',
        'rowOptions'=>['class'=>'info']
    ],

    [
        'columns' => [
            [
                'attribute'=>'id_persona', 
                'label'=>'ID Persona',
                'displayOnly'=>true,
                'valueColOptions'=>['style'=>'width:30%']
            ],
            [
                'attribute'=>'rut', 
                'format'=>'raw', 
                'valueColOptions'=>['style'=>'width:30%'], 
                'displayOnly'=>true
            ],
        ],
    ],

    [
        'columns' => [
            [
               'attribute'=>'nombre', 
                'label'=>'Nombre',
                'displayOnly'=>true,
                'valueColOptions'=>['style'=>'width:30%']
            ],
            [
                'attribute'=>'fecha_nacimiento', 
                'format'=>['date', 'php:d-m-Y'],
                'valueColOptions'=>['style'=>'width:30%'], 
            ],
        ],
    ],

    [
        'columns' => [
            [
                'attribute'=>'apellido',
                'valueColOptions'=>['style'=>'width:30%'],
            ],
            [
                'attribute'=>'email', 
                'format'=>'raw', 
                'valueColOptions'=>['style'=>'width:30%'], 
            ],
        ],
    ],
    
    [
        'columns' => [
            [
                'attribute'=>'telefono',
                'valueColOptions'=>['style'=>'width:30%'],
            ],
            [
                'attribute'=>'sexo', 
                'format'=>'raw', 
                'valueColOptions'=>['style'=>'width:30%'], 
            ],
        ],
    ],
    
   






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

