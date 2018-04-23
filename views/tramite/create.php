<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tramite */

$this->title = 'Ingresar Trámite';
$this->params['breadcrumbs'][] = ['label' => 'Trámites', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tramite-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
