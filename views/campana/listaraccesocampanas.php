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
$this->title = 'Lista de Usuarios ';
$columns=[

    ['class'=>'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT],
    
     [
                'attribute' => 'persona_id_persona',
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
   /** [
                'attribute' => 'persona_id_persona',
                'label' => 'Rut',
                'value' => function($model){
                    return $model->personaIdPersona->rut;
                },
            ],*/
    [
                'attribute' => 'persona_id_persona',
                'label' => 'Fecha Nacimiento',
                'value' => function($model){
                    return $model->personaIdPersona->fecha_nacimiento;
                },
            ],
    [
                'attribute' => 'persona_id_persona',
                'label' => 'Sexo',
                'value' => function($model){
                    return $model->personaIdPersona->sexo;
                },
            ],
     [
                'attribute' => 'persona_id_persona',
                'label' => 'Tipo Usuario',
                'value' => function($model){
                    return $model->rolIdRol->tipo;
                },
            ],


     [
                'attribute' => 'persona_id_persona',
                'label' => 'Comuna',
                'value' => function($model){
                    return $model->comunaIdComuna->nombre;
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
        'panel'=>['heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-tasks"></i>&nbsp;'.'Usuarios que han accedido a la Campaña "'.$model->titulo.'"</h3>'],
        'toolbar' =>  ['{toggleData}',],
    ],
    'options'=>['id'=>'dynagrid-1'] // a unique identifier is important
]) ?>

</div>
