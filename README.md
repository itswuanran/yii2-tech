# 后台管理系统beta

## 安装说明：

```bash
git clone https://github.com/anruence/yii2-tech.git

cd yii2-tech

composer install --no-dev
```

## 数据库迁移
 
 - 先解压tech.sql.zip文件。
 - tech.sql中保存了sql语句，暂时没写migrate脚本。后续会扩展。
 - 后台 用户名：test 密码：testpass

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
- 商品管理(详情页集成ckeditor)
![商品管理](https://github.com/anruence/yii2-tech/raw/master/docs/oneproduct.png
 "商品管理")
- 树形分类
![树形分类](https://github.com/anruence/yii2-tech/raw/master/docs/category.png
 "树形分类")
- audit访问记录
![audit](https://github.com/anruence/yii2-tech/raw/master/docs/audit.png
 "audit")
![trails](https://github.com/anruence/yii2-tech/raw/master/docs/trails.png
 "trails")
- calendar展示
![calendar](https://github.com/anruence/yii2-tech/raw/master/docs/calendar.png
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

## elasticsearch接入（TODO）

## OAuth2.0配置

### 添加oauth2.0的配置文件

```php
    'modules' => [
        'oauth2' => [
            'class' => 'filsh\yii2\oauth2server\Module',
            'tokenParamName' => 'accessToken',
            'tokenAccessLifetime' => 3600 * 24,
            'storageMap' => [
                'user_credentials' => 'frontend\models\User'
            ],
            'grantTypes' => [
                'client_credentials' => [
                    'class' => 'OAuth2\GrantType\ClientCredentials',
                    'allow_public_clients' => false
                ],
                'user_credentials' => [
                    'class' => 'OAuth2\GrantType\UserCredentials'
                ],
                'refresh_token' => [
                    'class' => 'OAuth2\GrantType\RefreshToken',
                    'always_issue_new_refresh_token' => true
                ]
            ],
        ],
    ],
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'POST oauth2/<action:\w+>' => 'oauth2/rest/<action>',
            ],
        ],
    ]
```
### 创建Oauth Server所需数据表
```
php yii migrate --migrationPath=@vendor/filsh/yii2-oauth2-server/migrations
```
原作者的migrate脚本有些小问题，参见：
https://github.com/Filsh/yii2-oauth2-server/issues/109
但在composer仓库中的版本并未修复，正确代码参考：
https://github.com/Filsh/yii2-oauth2-server/blob/master/migrations/m140501_075311_add_oauth2_server.php

在 oauth_client表中有一条测试记录，需要将http://fake/修改成自定义的domain name。(本例中为：http://api.domain.app/)
### 模拟发送Post请求(Postman)
- 获取token
http://api.domain.app/oauth/token

```
grant_type:password
username:tuser
password:tpass
client_id:testclient
client_secret:testpass
```
- GET 请求获取code
http://api.tech.app/oauth/authorize?response_type=code&client_id=testclient&redirect_uri=http://api.tech.app/oauth/authcode&state=xyz
获取code，然后code换token。
```
grant_type:authorization_code
code:code
client_id:testclient
client_secret:dbsecret
redirect_uri:http://api.tech.app/oauth/authcode
```

## sso系统（TODO）

## 支付系统

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

 本项目主要是Yii2常见组件的使用积累，仅供学习参考，如需线上应用请folk然后自由定制自己所需功能。