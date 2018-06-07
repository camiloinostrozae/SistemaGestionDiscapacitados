<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Button;
use yii\bootstrap\ButtonDropdown;
use p2m\helpers\FA;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use kartik\markdown\MarkdownEditor;
use froala\froalaeditor\FroalaEditorWidget;
use app\models\TipoTramite;
/* @var $this yii\web\View */
/* @var $model app\models\Tramite */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tramite-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'titulo')->textarea(['rows'=>1,'placeholder'=>'Ingrese el título del trámite' ]) ?>
    <?= $form->field($model, 'contenido')->textarea(['rows'=>10, 'placeholder'=>'Ingrese el contenido del trámite']) ?>

    <!--$form->field($model, 'contenido')->widget(
    FroalaEditorWidget::classname(), 
    [
        'name' => 'content',
        'options' => [
            // html attributes
            'id'=>'content'
        ],
        'clientOptions' => [
            'height' => 200,
            'toolbarInline'=> false,
            'toolbarButtons'=>['fullscreen', 'bold', 'italic', 'underline', 'strikeThrough', '|', 'fontFamily', 'fontSize', '|', 'paragraphFormat', 'align', 'formatOL', 'formatUL', 'outdent', 'indent', '-', '|', 'selectAll', 'clearFormatting', '|', 'spellChecker', 'help', 'html', '|', 'undo', 'redo'],
            'theme' =>'custom', 
            'language'=>'es',
            'pluginsEnabled'=> ['lists']
        ]
    ]
); -->
    
        <?= $form->field($model, 'fecha_vencimiento')->widget(
    DatePicker::classname(),
    [
	'name' => 'check_issue_date', 
	'value' => date('d-M-Y', strtotime('+2 days')),
	'options' => ['placeholder' => 'Seleccione una fecha'],
	'pluginOptions' => [
		'format' => 'dd-mm-yyyy',
		'todayHighlight' => true,
        'autoclose' =>true,
        'startDate' => '0d'
	]
]); ?>

     <?= $form->field($model, 'id_tipo_tramite')->widget(Select2::classname(), [
        'data' => TipoTramite::getTipoTramite(),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione un tipo de trámite'],
        'pluginOptions' => [
            'allowClear' => true
    ],
]); ?>

    <div class="form-group">
        <?= Html::submitButton('Enviar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
