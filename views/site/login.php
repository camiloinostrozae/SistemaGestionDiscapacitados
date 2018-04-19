<?php
/**
 * login.php
 *
 * @author Pedro Plowman
 * @copyright Copyright &copy; Pedro Plowman, 2017
 * @link https://github.com/p2made
 * @package p2made/yii2-sb-admin-theme
 * @license MIT
 */

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use p2m\helpers\FA;
use p2m\helpers\BSocial;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Login';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback', 'autofocus' => 'autofocus'],
    'inputTemplate' => "{input}<i class='glyphicon glyphicon-envelope form-control-feedback'></i>",
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<i class='glyphicon glyphicon-lock form-control-feedback'></i>",
];
?>

<body style="background-color:#000033;">
    
    <div class="container">
       <div> <?php echo Html::img('@web/images/logopdi.png')?></div>
    </div>
    <div class="sb-box">
        <div class="sb-logo">
            <?= Html::a('<b>P<sup>2</sup>SB</b> Admin v2.0', Yii::$app->homeUrl) ?>
        </div>
        <div class="sb-box-body panel panel-default">
            <div class="panel-body">

                <p class="sb-box-msg">Login to start your session</p>

                <?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'enableClientValidation' => false
]); ?>

                <?= $form
    ->field($model, 'username', $fieldOptions1)
    ->label(false)
    ->textInput(['placeholder' => $model->getAttributeLabel('Email')])
                ?>

                <?= $form
    ->field($model, 'password', $fieldOptions2)
    ->label(false)
    ->passwordInput(['placeholder' => $model->getAttributeLabel('Contraseña')])
                ?>

                <div class="row">
                    <div class="col-xs-6">
                        <?= Html::submitButton('Iniciar Sesión', [
                    'class' => 'btn btn-primary btn-block btn-flat',
                    'name' => 'login-button'
                ]) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

    </div>
</body>