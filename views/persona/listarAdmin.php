<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
//use yii\bootstrap\Html;
use yii\bootstrap\Button;
use yii\bootstrap\ButtonDropdown;
use yii\bootstrap\ActiveForm;
use kartik\dynagrid\DynaGrid;
use kartik\grid\GridView;
use app\models\Persona;
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
$this->title = 'Lista de Administradores';
$columns=[

    ['class'=>'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT],
    [
        'attribute'=>'nombre',
        'pageSummary'=>'Page Total',
        'vAlign'=>'middle',
        'order'=>DynaGrid::ORDER_FIX_LEFT,
        'contentOptions'=>['style'=>'max-width: 100px;overflow: auto; word-wrap: break-word;']
    ],

    [
        'attribute'=>'apellido',
        'pageSummary'=>'Page Total',
        'vAlign'=>'middle',
        'order'=>DynaGrid::ORDER_FIX_LEFT,
        'contentOptions'=>['style'=>'max-width: 300px;max-height: 150px;overflow: auto; word-wrap: break-word;white-space: nowrap;'],
    ],
    

    [
        'attribute'=>'email',
        'pageSummary'=>'Page Total',
        'vAlign'=>'middle',
        'order'=>DynaGrid::ORDER_FIX_LEFT,
        'contentOptions'=>['style'=>'max-width: 300px;max-height: 150px;overflow: auto; word-wrap: break-word;white-space: nowrap;'],
    ],
    
    [
                'attribute' => 'rol_id_rol',
                'value' => function($model){
                    return $model->rolIdRol->tipo;
                },
            ],
     [
                'attribute' => 'comuna_id_comuna',
                'value' => function($model){
                    return $model->comunaIdComuna->nombre;
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
        'template'=>'{view}{update}{delete}',

        'buttons'=>[

            'delete' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url,

                               [  
                                   'title' => Yii::t('yii', 'Eliminar'),
                                   'data-confirm' => "¿Esta seguro de eliminar a este administrador?",
                                   'data-method' => 'post',
                                   'data-pjax' => 0
                               ]);
            },

            'update' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url,

                               [  
                                   'title' => Yii::t('yii', 'Actualizar'),
                                   'data-method'=>'post',
                                    
                               ]);
            },
            'view' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url,

                               ['title' => Yii::t('yii', 'Ver'),
                                'data-toggle'=>"modal",
                                'data-target'=>"#myModal",
                                'data-title'=>"Detalle del Administrador",]);
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
        'panel'=>['heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-tasks"></i>&nbsp;Administradores</h3>'],
        'toolbar' =>  ['{toggleData}',],
    ],
    'options'=>['id'=>'dynagrid-1'] // a unique identifier is important
]) ?>


    <?php
    Modal::begin([
        'id' => 'myModal',
     'header' => '<h4 class="modal-title">Detail View Demo</h4>',
        'size' => 'modal-lg',
    'options' => ['tabindex' => false]
    ]);
    Modal::end();
    ?>
<?php
  $this->registerJs("
    $('#myModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var modal = $(this)
        var title = button.data('title') 
        var href = button.attr('href') 
        modal.find('.modal-title').html(title)
        modal.find('.modal-body').html('<i class=\"fa fa-spinner fa-spin\"></i>')
        $.post(href)
            .done(function( data ) {
                modal.find('.modal-body').html(data)
            });
        })
");
?>

</div>
