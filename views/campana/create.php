<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Campana */

$this->title = 'Create Campana';
$this->params['breadcrumbs'][] = ['label' => 'Campanas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="campana-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
