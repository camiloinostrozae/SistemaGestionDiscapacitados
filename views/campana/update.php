<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Campana */

$this->title = 'Update Campana: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Campanas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_campana, 'url' => ['view', 'id' => $model->id_campana]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="campana-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
