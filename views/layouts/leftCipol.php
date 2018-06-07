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
                'label' => 'Llamadas',
                'icon' => 'tasks',
                'url' => '#',
                'items' => [
                    ['label' => 'Listar Llamadas', 'icon' => 'file-code-o', 'url' => ['/llamada/listar'],],
                ],
            ],

        ],
    ]
) ?>


    </section>

</aside>
