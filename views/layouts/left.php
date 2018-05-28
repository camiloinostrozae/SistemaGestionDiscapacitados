<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left info">
            
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
    [
        'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
        'items' => [

           // ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],

            [
                'label' => 'Campañas',
                'icon' => 'tasks',
                'url' => '#',
                'items' => [
                    ['label' => 'Ingresar Campaña', 'icon' => 'file-code-o', 'url' => ['/campana/index'],],
                    ['label' => 'Listar Campañas', 'icon' => 'dashboard', 'url' => ['/campana/listar'],],
                ],
            ],


            [
                'label' => 'Trámites',
                'icon' => 'tasks',
                'url' => '#',
                'items' => [
                    ['label' => 'Ingresar Trámite', 'icon' => 'file-code-o', 'url' => ['/tramite/index'],],
                    ['label' => 'Listar Trámites', 'icon' => 'dashboard', 'url' => ['/tramite/listar'],],
                ],
            ],


            [
                'label' => 'Administrador',
                'icon' => 'user',
                'url' => '#',
                'items' => [

                    ['label' => 'Ingresar Administrador', 'icon' => 'user-plus', 'url' => ['/persona/administrador'],],

                    ['label' => 'Listar Administradores', 'icon' => 'users', 'url' => ['/persona/listaradministradores'],],
                ],
            ],


            [
                'label' => 'Usuarios Discapacitados',
                'icon' => 'user',
                'url' => '#',
                'items' => [
                    ['label' => 'Ingresar Usuario ', 'icon' => 'user-plus', 'url' => ['/persona/discapacitado'],],
                    ['label' => 'Listar Usuarios', 'icon' => 'users', 'url' => ['/persona/listardiscapacitados'],],
                ],
            ],


            [
                'label' => 'No Discapacitados',
                'icon' => 'user',
                'url' => '#',
                'items' => [
                    ['label' => 'Listar Usuarios', 'icon' => 'users', 'url' => ['/persona/listarnodiscapacitados'],],
                ],
            ],
    [
                'label' => 'Estadísticas',
                'icon' => 'tasks',
                'url' => '#',
                'items' => [
                    ['label' => 'Listar Acceso a Campañas', 'icon' => 'dashboard', 'url' => ['/campana/listarcampanas'],],
                    ['label' => 'Listar Acceso a Trámites', 'icon' => 'dashboard', 'url' => ['/tramite/listartramites'],],
                ],
            ],
        ],
    ]
) ?>


    </section>

</aside>
