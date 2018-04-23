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

/* @var $this yii\web\View */
/* @var $model app\models\Tramite */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tramite-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'titulo')->textarea(['placeholder'=>'Ingrese el título del Trámite']) ?>

    <?= $form->field($model, 'contenido')->widget(
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
); ?>
    
        <?= $form->field($model, 'fecha_vencimiento')->widget(
    DatePicker::classname(),
    [
	'name' => 'check_issue_date', 
	'value' => date('d-M-Y', strtotime('+2 days')),
	'options' => ['placeholder' => 'Seleccione una fecha ...'],
	'pluginOptions' => [
		'format' => 'dd-mm-yyyy',
		'todayHighlight' => true
	]
]); ?>

    <?= $form->field($model, 'id_tipo_tramite')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
