<?php
use yii\helpers\Html;

use app\models\Persona;


/* @var $this \yii\web\View */
/* @var $content string */
 
?>



<header class="main-header">

    <?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg">' . "Inicio" . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="width: 55px;height: 50px;">
                        <img src="<?= $directoryAsset ?>/img/pdi.png" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= $directoryAsset ?>/img/pdi.png" class="img-circle"/>

                           
                                
                                <?php 
                                echo '<p>';
                                if(isset(Yii::$app->user->identity->rol_id_rol)){
                                    $rol = Yii::$app->user->identity->rol_id_rol;
                                    if($rol==1){
                                        echo 'Administrador';
                                        echo '<br>' ;   
                                    }else{
                                        if($rol==2){
                                            echo 'Administrador CIPOL';
                                            echo '<br>' ;
                                        }
                                    }
                                    
                                }
    
                                if (isset(Yii::$app->user->identity->nombre)){
                                    $nombre = Yii::$app->user->identity->nombre; 
                                    echo $nombre;
                                    echo ' ';
                                }
                                 if (isset(Yii::$app->user->identity->apellido)){
                                    $apellido = Yii::$app->user->identity->apellido; 
                                    echo $apellido;
                                }
                                
                                echo '</p>';
                            
                                ?> 
                                 
                            
                        </li>
                        
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left" style="text-align=center;padding-left:70px;">
                                <?= Html::a(
                                    'Cerrar Sesión',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>

               
            </ul>
        </div>
    </nav>
</header>
