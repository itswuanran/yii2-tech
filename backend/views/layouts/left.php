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
                    ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    ['label' => '分类管理', 'icon' => 'fa fa-th-list', 'url' => ['/category'],],
                    ['label' => '用户管理', 'icon' => 'fa fa-users', 'url' => ['/user'],],
                    [
                        'label' => '一元夺宝',
                        'icon' => 'fa fa-circle-o',
                        'url' => '#',
                        'items' => [
                            ['label' => '商品管理', 'icon' => 'fa fa-circle-o', 'url' => '/oneproduct',],
                            ['label' => '期数管理', 'icon' => 'fa fa-circle-o', 'url' => '/oneproterm',],
                            ['label' => '抽奖管理', 'icon' => 'fa fa-circle-o', 'url' => '/onelottery',],
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
        <ul class="sidebar-menu">
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gears"></i> <span>权限控制</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/admin/route"><i class="fa fa-circle-o"></i> 路由</a></li>
                    <li><a href="/admin/permission"><i class="fa fa-circle-o"></i> 权限</a></li>
                    <li><a href="/admin/role"><i class="fa fa-circle-o"></i> 角色</a></li>
                    <li><a href="/admin/assignment"><i class="fa fa-circle-o"></i> 分配</a></li>
                    <li><a href="/admin/menu"><i class="fa fa-circle-o"></i> 菜单</a></li>
                </ul>
            </li>
        </ul>
    </section>
</aside>
