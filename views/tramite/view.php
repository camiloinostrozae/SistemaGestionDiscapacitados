<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tramite */
/*
$this->title = $model->id_tramite;
$this->params['breadcrumbs'][] = ['label' => 'Tramites', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tramite-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_tramite], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_tramite], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_tramite',
            'titulo:ntext',
            'contenido:ntext',
            'fecha_publicacion',
            'fecha_vencimiento',
            'estado',
            'id_tipo_tramite',
        ],
    ]) ?>

</div>*/
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
                'attribute'=>'id_tramite', 
                'label'=>'Trámite Número',
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

