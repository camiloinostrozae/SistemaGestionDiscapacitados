<?php

use yii\helpers\Html;
use yii\bootstrap\Button;
use yii\bootstrap\ButtonDropdown;
use p2m\helpers\FA;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use kartik\markdown\MarkdownEditor;
use froala\froalaeditor\FroalaEditorWidget;
use app\models\TipoCampana;
/* @var $this yii\web\View */
/* @var $model app\models\Campana */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="campana-form">
    <?php

    /*
     <?= $form->field($model, 'contenido')->widget(
            MarkdownEditor::classname(), 
            ['height' => 300, 'encodeLabels' => false]
            ); 
     

    */
    
    //use HtmlBootstrap;
    ///use FormBootstrap;
    $form = ActiveForm::begin([

        'id' => 'createCampana-form-vertical', 
        'type' => ActiveForm::TYPE_VERTICAL,
        'fieldConfig' => ['autoPlaceholder'=>false]
    ]);
    ?>
    <?= $form->field($model, 'titulo')->textarea(['placeholder'=>'Ingrese el título de la campaña']) ?>



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


    <?= $form->field($model, 'id_tipo_campana')->widget(Select2::classname(), [
        'data' => TipoCampana::getTipoCampana(),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione un tipo de campaña ...'],
        'pluginOptions' => [
            'allowClear' => true
    ],
]); ?>

    <div class="form-group">
        <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
