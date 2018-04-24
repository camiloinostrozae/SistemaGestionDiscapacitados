<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Persona */

$this->title = 'Actualizar Usuario: '.$model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_persona, 'url' => ['view', 'id' => $model->id_persona]];
$this->params['breadcrumbs'][] = 'Actualizar Usuario';
?>
<div class="persona-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
