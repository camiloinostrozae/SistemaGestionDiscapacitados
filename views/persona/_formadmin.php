<?php

use yii\helpers\Html;
use yii\bootstrap\Button;
use yii\bootstrap\ButtonDropdown;
use p2m\helpers\FA;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use app\models\Rol;
use app\models\Comuna;
/* @var $this yii\web\View */
/* @var $model app\models\Campana */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="persona-form">
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

        'id' => 'createPersona-form-vertical', 
        'type' => ActiveForm::TYPE_VERTICAL,
        'fieldConfig' => ['autoPlaceholder'=>false]
    ]);
    ?>
    <?= $form->field($model, 'nombre')->textInput(['placeholder'=>'Ingrese el nombre']) ?>
    <?= $form->field($model, 'apellido')->textInput(['placeholder'=>'Ingrese el apellido']) ?>
    <?= $form->field($model, 'rut')->textInput(['placeholder'=>'Ingrese el Rut']) ?>
    <?= $form->field($model, 'fecha_nacimiento')->widget(
    DatePicker::classname(),
    [
	'name' => 'check_issue_date', 
	'value' => date('d-M-Y', strtotime('+2 days')),
	'options' => ['placeholder' => 'Seleccione una fecha de nacimiento'],
	'pluginOptions' => [
		'format' => 'dd-mm-yyyy',
		'todayHighlight' => true
	]
]); ?>

    <?= $form->field($model, 'email')->textInput(['placeholder'=>'Ingrese el email']) ?>
    <?= $form->field($model, 'telefono')->textInput(['placeholder'=>'Ingrese el número de teléfono']) ?>
    <?= $form->field($model, 'sexo')->dropDownList(['Masculino' => 'Masculino', 'Femenino' => 'Femenino'],['prompt'=>'Seleccione el Sexo'])?>
    <?= $form->field($model, 'contrasena')->passwordInput(['placeholder'=>'Ingrese la contraseña']) ?>

    <?= $form->field($model, 'rol_id_rol')->widget(Select2::classname(), [
        'data' => Rol::getTipoAdministrador(),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione un tipo de administrador ...'],
        'pluginOptions' => [
            'allowClear' => true
    ],
]); ?>
    
        <?= $form->field($model, 'comuna_id_comuna')->widget(Select2::classname(), [
        'data' => Comuna::getComunas(),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione la comuna ...'],
        'pluginOptions' => [
            'allowClear' => true
    ],
]); ?>

    <div class="form-group">
        <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
