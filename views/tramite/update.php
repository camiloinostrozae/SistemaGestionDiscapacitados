<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tramite */

$this->title = 'Actualizar Trámite: '.$model->titulo;

?>
<div class="tramite-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
