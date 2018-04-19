<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TipoTramite */

$this->title = 'Create Tipo Tramite';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Tramites', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-tramite-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
