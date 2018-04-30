<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Campana */

$this->title = 'Actualizar Campaña: '.$model->titulo;
?>
<div class="campana-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
