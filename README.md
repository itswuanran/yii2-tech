# 后台管理系统beta

## 安装说明：

```bash
git clone https://github.com/anruence/yii2-tech.git

cd yii2-tech

composer install --no-dev
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

## 集成了yii2-audit组件，如需使用迁移表即可

php yii migrate --migrationPath=@bedezign/yii2/audit/migrations

```

提供了sql文件，可以用命令直接导入。

```bash
mysql -uusername -ppassword dbname < tech.sql
```
## 效果图

- 前端页面
![前端页面](https://github.com/anruence/yii2-tech/raw/master/docs/tech.png
 "前端页面")

- 后台管理
![后台管理](https://github.com/anruence/yii2-tech/raw/master/docs/backend.png
 "后台管理")

## 树形分类功能暂时只更新部分代码
- 分类管理
![分类管理](https://github.com/anruence/yii2-tech/raw/master/docs/category.png
 "分类管理")
- 商品管理(详情页待集成ckeditor)
![商品管理](https://github.com/anruence/yii2-tech/raw/master/docs/oneproduct.png
 "商品管理")
- audit访问记录
![audit](https://github.com/anruence/yii2-tech/raw/master/docs/audit.png
 "audit")
- calendar
![audit](https://github.com/anruence/yii2-tech/raw/master/docs/calendar.png
 "calendar")

## nginx配置

建议配置多个二级域名


```
# 支付端
server {
    listen       80;
    server_name  pay.domain.app;
    root  /data/yii2-tech/pay/web;
    index index.php;
    location / {
        try_files $uri /index.php?$args;
        # index index.php index.html;
    }

    location ~ \.php$ {
        fastcgi_index  index.php;
        fastcgi_pass unix:/var/run/php7.0-fpm.sock;
        # fastcgi_pass 127.0.0.1:9000;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
# 博客端
server {
    listen       80;
    server_name  tech.domain.app;
    root  /data/yii2-tech/tech/web;
    index index.php;
    location / {
        try_files $uri /index.php?$args;
        # index index.php index.html;
    }

    location ~ \.php$ {
        fastcgi_index  index.php;
        fastcgi_pass unix:/var/run/php7.0-fpm.sock;
        # fastcgi_pass 127.0.0.1:9000;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
# 后端mis
server {
    listen       80;
    server_name  mis.domain.app;
    root  /data/yii2-tech/backend/web;
    index index.php;
    location / {
        try_files $uri /index.php?$args;
        # index index.php index.html;
    }

    location ~ \.php$ {
        fastcgi_index  index.php;
        fastcgi_pass unix:/var/run/php7.0-fpm.sock;
        # fastcgi_pass 127.0.0.1:9000;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}

# 前端应用
server {
    listen       80;
    server_name  www.domain.app;
    root  /data/yii2-tech/frontend/web;
    index index.php;
    location / {
        try_files $uri /index.php?$args;
        # index index.php index.html;
    }

    location ~ \.php$ {
        fastcgi_index  index.php;
        fastcgi_pass unix:/var/run/php7.0-fpm.sock;
        # fastcgi_pass 127.0.0.1:9000;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

## 支付系统正在开发中

> 微信（支持多商户，APP & H5）

> 支付宝（支持多商户，APP & H5）

## 增加seotools配置
```
php yii migrate --migrationPath=@vendor/jpunanua/yii2-seotools/migrations

```
### seotools路由
- seotools/manage
- seotools/manage/create


## 备注

 本项目东西会很多很杂，主要是Yii2常见组件的使用积累，仅供学习参考。