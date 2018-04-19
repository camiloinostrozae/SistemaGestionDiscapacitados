<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\InteractuarTramite */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="interactuar-tramite-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'persona_id_persona')->textInput() ?>

    <?= $form->field($model, 'tramite_id_tramite')->textInput() ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'hora')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
