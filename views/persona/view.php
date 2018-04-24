<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
//use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Persona */
/*
$this->title = $model->id_persona;
$this->params['breadcrumbs'][] = ['label' => 'Personas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="persona-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_persona], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_persona], [
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
            'id_persona',
            'nombre',
            'apellido',
            'rut',
            'fecha_nacimiento',
            'email:email',
            'telefono',
            'sexo',
            'contrasena',
            'comuna_id_comuna',
            'rol_id_rol',
        ],
    ]) ?>

</div>*/
?>


<?php 

$atributos = [
    [
        'group'=>true,
        'label'=>'Acerca del Usuario',
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
                'format'=>'raw', 
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
    
    [
        'columns' => [
            [
                'attribute'=>'comuna_id_comuna',
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
    'panel'=>[
        'heading'=>'Usuario # ' . $model->id_persona,
        'type'=>DetailView::TYPE_INFO,
    ],
    'attributes' => $atributos




]) ?>



</div>

