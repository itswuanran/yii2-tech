<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                'items' => [
                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'Blog', 'icon' => 'file-code-o', 'url' => ['/blog']],
                    ['label' => '一个文章', 'icon' => 'file-code-o', 'url' => ['/onearticle']],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    ['label' => '分类管理', 'icon' => 'th-list', 'url' => ['/category'],],
                    ['label' => '用户管理', 'icon' => 'users', 'url' => ['/user'],],
                    [
                        'label' => '一元活动',
                        'icon' => 'circle-o',
                        'url' => '#',
                        'items' => [
                            ['label' => '商品管理', 'icon' => 'circle-o', 'url' => '/product/index',],
                            ['label' => '抽奖管理', 'icon' => 'circle-o', 'url' => '/lottery/index',],
                        ],
                    ],
                    [
                        'label' => '权限控制',
                        'icon' => 'gears',
                        'url' => '#',
                        'items' => [
                            ['label' => '路由', 'icon' => 'circle-o', 'url' => '/admin/route',],
                            ['label' => '权限', 'icon' => 'circle-o', 'url' => '/admin/permission',],
                            ['label' => '角色', 'icon' => 'circle-o', 'url' => '/admin/role',],
                            ['label' => '分配', 'icon' => 'circle-o', 'url' => '/admin/assignment',],
                            ['label' => '菜单', 'icon' => 'circle-o', 'url' => '/admin/menu',],
                        ],
                    ],
                    [
                        'label' => 'Same tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            ['label' => 'Audit', 'icon' => 'dashboard', 'url' => ['/audit'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ) ?>
    </section>
</aside>
