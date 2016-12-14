# yii2-tech
# 后台管理系统beta

## 安装说明：

```bash
git clone https://github.com/anruence/yii2-tech.git
cd yii-tech
composer install
```

## 数据库迁移
 - tech.sql中保存了sql语句，暂时没写migrate脚本。后续会扩展。

修改测试环境的common/config/main-local.php文件

> environments/dev/common/config/main-local.php

正式环境对应
> environments/prod/common/config/main-local.php

```php
<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=tech',
            'username' => 'your-username',
            'password' => 'your-password',
            'charset' => 'utf8',
        ],
        //...
    ],
];

```


```bash
php yii migrate

php yii migrate --migrationPath=@yii/rbac/migrations

## 使用了yii2-admin组件，如果需要配置菜单执行下面命令

php yii migrate --migrationPath=@mdm/admin/migrations

```

## nginx配置

TBD
```

```
