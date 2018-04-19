<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\InteractuarTramite */

$this->title = $model->persona_id_persona;
$this->params['breadcrumbs'][] = ['label' => 'Interactuar Tramites', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="interactuar-tramite-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'persona_id_persona' => $model->persona_id_persona, 'tramite_id_tramite' => $model->tramite_id_tramite], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'persona_id_persona' => $model->persona_id_persona, 'tramite_id_tramite' => $model->tramite_id_tramite], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'persona_id_persona',
            'tramite_id_tramite',
            'fecha',
            'hora',
        ],
    ]) ?>

</div>
