<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tramite */

$this->title = 'Update Tramite: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Tramites', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_tramite, 'url' => ['view', 'id' => $model->id_tramite]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tramite-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
