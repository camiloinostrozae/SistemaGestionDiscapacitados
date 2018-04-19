<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TipoCampana */

$this->title = 'Update Tipo Campana: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Campanas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_tipo_campana, 'url' => ['view', 'id' => $model->id_tipo_campana]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tipo-campana-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
