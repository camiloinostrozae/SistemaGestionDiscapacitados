<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\InteractuarTramite */

$this->title = 'Update Interactuar Tramite: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Interactuar Tramites', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->persona_id_persona, 'url' => ['view', 'persona_id_persona' => $model->persona_id_persona, 'tramite_id_tramite' => $model->tramite_id_tramite]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="interactuar-tramite-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
