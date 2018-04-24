<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Campana */

$this->title = 'Registrar Administrador';
?>
<div class="persona-create">

    <?= $this->render('_formadmin', [
        'model' => $model,
    ]) ?>

</div>
