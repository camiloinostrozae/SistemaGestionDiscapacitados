<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Persona */

$this->title = 'Actualizar Usuario: '.$model->nombre." ".$model->apellido;
?>
<div class="persona-update">

    <?= $this->render('_formnodisc', [
        'model' => $model,
    ]) ?>

</div>
