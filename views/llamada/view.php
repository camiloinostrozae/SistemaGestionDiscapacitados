<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Llamada */

$this->title = $model->id_llamada;
$this->params['breadcrumbs'][] = ['label' => 'Llamadas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="llamada-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_llamada], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_llamada], [
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
            'id_llamada',
            'fecha',
            'hora',
            'ubicacion_id_ubicacion',
            'persona_id_persona',
        ],
    ]) ?>

</div>
