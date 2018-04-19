<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\InteractuarCampana */

$this->title = 'Update Interactuar Campana: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Interactuar Campanas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->persona_id_persona, 'url' => ['view', 'persona_id_persona' => $model->persona_id_persona, 'campana_id_campana' => $model->campana_id_campana]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="interactuar-campana-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
