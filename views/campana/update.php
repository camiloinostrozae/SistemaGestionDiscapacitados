<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Campana */

$this->title = 'Actualizar Campaña: '.$model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Campañas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_campana, 'url' => ['view', 'id' => $model->id_campana]];
$this->params['breadcrumbs'][] = 'Actualizar Campaña';
?>
<div class="campana-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
