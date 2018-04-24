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
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
    [
        'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
        'items' => [

            ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],

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

                    ['label' => 'Listar Administradores', 'icon' => 'users', 'url' => ['/debug'],],
                ],
            ],


            [
                'label' => 'Usuarios Discapacitados',
                'icon' => 'user',
                'url' => '#',
                'items' => [
                    ['label' => 'Ingresar Usuario ', 'icon' => 'user-plus', 'url' => ['/tramite/index'],],
                    ['label' => 'Listar Usuarios', 'icon' => 'users', 'url' => ['/debug'],],
                ],
            ],


            [
                'label' => 'Usuarios simple',
                'icon' => 'user',
                'url' => '#',
                'items' => [
                    ['label' => 'Ingresar Usuario ', 'icon' => 'user-plus', 'url' => ['/tramite/index'],],
                    ['label' => 'Listar Usuarios', 'icon' => 'users', 'url' => ['/debug'],],
                ],
            ],
        ],
    ]
) ?>


    </section>

</aside>
