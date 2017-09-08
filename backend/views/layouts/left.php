<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
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
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'Blog', 'icon' => 'fa fa-file-code-o', 'url' => ['/blog']],
                    ['label' => '一个文章', 'icon' => 'fa fa-file-code-o', 'url' => ['/onearticle']],
                    ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    ['label' => '分类管理', 'icon' => 'fa fa-th-list', 'url' => ['/category'],],
                    ['label' => '用户管理', 'icon' => 'fa fa-users', 'url' => ['/user'],],
                    [
                        'label' => '一元活动',
                        'icon' => 'fa fa-circle-o',
                        'url' => '#',
                        'items' => [
                            ['label' => '商品管理', 'icon' => 'fa fa-circle-o', 'url' => '/product',],
                            ['label' => '抽奖管理', 'icon' => 'fa fa-circle-o', 'url' => '/lottery',],
                        ],
                    ],
                    [
                        'label' => '权限控制',
                        'icon' => 'fa fa-gears',
                        'url' => '#',
                        'items' => [
                            ['label' => '路由', 'icon' => 'fa fa-circle-o', 'url' => '/admin/route',],
                            ['label' => '权限', 'icon' => 'fa fa-circle-o', 'url' => '/admin/permission',],
                            ['label' => '角色', 'icon' => 'fa fa-circle-o', 'url' => '/admin/role',],
                            ['label' => '分配', 'icon' => 'fa fa-circle-o', 'url' => '/admin/assignment',],
                            ['label' => '菜单', 'icon' => 'fa fa-circle-o', 'url' => '/admin/menu',],
                        ],
                    ],
                    [
                        'label' => 'Same tools',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'],],
                            ['label' => 'Audit', 'icon' => 'fa fa-dashboard', 'url' => ['/audit'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'fa fa-circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'fa fa-circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
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
