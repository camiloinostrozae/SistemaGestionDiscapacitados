<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\InteractuarCampana */

$this->title = $model->persona_id_persona;
$this->params['breadcrumbs'][] = ['label' => 'Interactuar Campanas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="interactuar-campana-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'persona_id_persona' => $model->persona_id_persona, 'campana_id_campana' => $model->campana_id_campana], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'persona_id_persona' => $model->persona_id_persona, 'campana_id_campana' => $model->campana_id_campana], [
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
            'campana_id_campana',
            'fecha',
            'hora',
        ],
    ]) ?>

</div>
