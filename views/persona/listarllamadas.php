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
$this->title = 'Lista de Llamadas ';
$columns=[

    ['class'=>'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT],
    
     [
                'attribute' => 'persona_id_persona',
                'label' => 'Teléfono',
                'value' => function($model){
                    return $model->personaIdPersona->telefono;
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
'panel'=>['heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-tasks"></i>&nbsp;'.'Llamadas realizadas por '.$model->nombre.' '.$model->apellido.'</h3>'],
    ],
    'options'=>['id'=>'dynagrid-1'] // a unique identifier is important
]) ?>

</div>
