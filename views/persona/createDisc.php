<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Persona */

$this->title = 'Ingresar Discapacitado Visual';

?>
<div class="persona-create">

    <?= $this->render('_formdisc', [
        'model' => $model,
    ]) ?>

</div>
