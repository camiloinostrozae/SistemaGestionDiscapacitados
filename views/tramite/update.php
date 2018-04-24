<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tramite */

$this->title = 'Actualizar Trámite: '.$model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Trámites', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_tramite, 'url' => ['view', 'id' => $model->id_tramite]];
$this->params['breadcrumbs'][] = 'Actualizar Trámite';
?>
<div class="tramite-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
