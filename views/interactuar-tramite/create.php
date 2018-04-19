<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\InteractuarTramite */

$this->title = 'Create Interactuar Tramite';
$this->params['breadcrumbs'][] = ['label' => 'Interactuar Tramites', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="interactuar-tramite-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
