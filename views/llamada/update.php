<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Llamada */

$this->title = 'Update Llamada: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Llamadas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_llamada, 'url' => ['view', 'id' => $model->id_llamada]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="llamada-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
