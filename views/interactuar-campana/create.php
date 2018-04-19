<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\InteractuarCampana */

$this->title = 'Create Interactuar Campana';
$this->params['breadcrumbs'][] = ['label' => 'Interactuar Campanas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="interactuar-campana-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
