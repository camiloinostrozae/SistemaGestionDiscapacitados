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
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use app\models\Region;
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
    <?= $form->field($model, 'rut')->textInput(['placeholder'=>'Ingrese el Rut con formato XXXXXXXX-Y','maxlength'=>10]) ?>
    <?= $form->field($model, 'fecha_nacimiento')->widget(
    DatePicker::classname(),
    [
	'name' => 'check_issue_date', 
	'value' => date('d-M-Y', strtotime('+2 days')),
	'options' => ['placeholder' => 'Seleccione una fecha de nacimiento'],
	'pluginOptions' => [
		'format' => 'dd-mm-yyyy',
		'todayHighlight' => true,
        'autoclose' =>true,
        'endDate' => '0d'
	]
]); ?>

    <?= $form->field($model, 'email')->textInput(['placeholder'=>'Ingrese el email']) ?>
    <?= $form->field($model, 'telefono')->textInput(['placeholder'=>'Ingrese el número de teléfono','maxlength'=>8, 'onKeypress' => 'if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;']) ?>
    <?= $form->field($model, 'sexo')->dropDownList(['Masculino' => 'Masculino', 'Femenino' => 'Femenino'],['prompt'=>'Seleccione el Sexo'])?>
    

    <?= $form->field($model, 'rol_id_rol')->widget(Select2::classname(), [
        'data' => Rol::getTipoAdministrador(),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione un tipo de administrador'],
        'pluginOptions' => [
            'allowClear' => true
    ],
]); ?>
    
    
    <?php
            $regiones = ArrayHelper::map(Region::find()->all(), 'id_region', 'nombre');
            echo $form->field($model, 'region_id')->dropDownList(
                $regiones,
                [
                    'prompt'=>'---Seleccione la Región---',
                    'onchange'=>'
                                    $.get( "'.Url::toRoute('dependent-dropdown/comuna').'", { id: $(this).val() } )
                                        .done(function( data ) {
                                            $( "#'.Html::getInputId($model, 'comuna_id_comuna').'" ).html( data );
                                        }
                                    );
                                '
                ]
            );
    
                $comuna = ArrayHelper::map(Comuna::find()->where(['id_comuna' =>$model->comuna_id_comuna])->all(), 'id_comuna', 'nombre');
                echo $form->field($model, 'comuna_id_comuna')->dropDownList($comuna);        
    
            ?>
            
            
                
            
    


    <div class="form-group">
        <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
