#!/usr/bin/env bash
yes y | php yii gii/model --tableName="order" --modelClass="Order" --db="db" --ns="common\models"
yes y | php yii gii/model --tableName="product" --modelClass="Product" --db="db" --ns="common\models"
yes y | php yii gii/model --tableName="community" --modelClass="Community" --db="db" --ns="common\models"
yes y | php yii gii/model --tableName="city" --modelClass="City" --db="db" --ns="common\models"
yes y | php yii gii/model --tableName="user" --modelClass="User" --db="db" --ns="common\models"
yes y | php yii gii/model --tableName="comment" --modelClass="User" --db="db" --ns="common\models"
yes y | php yii gii/model --tableName="onearticle" --modelClass="Onearticle" --db="db" --ns="common\models"
yes y | php yii gii/crud --controllerClass='backend\controllers\OnearticleController' --modelClass='common\models\Onearticle' --viewPath='backend/views/onearticle'

find . -type d | xargs rename 's/Oneproterm/Proterm/';
find . -type d | xargs rename 's/oneproterm/proterm/';

find ./ ! -path "./vendor/*" ! -path "./.git/*" -type f -name "*.php" | xargs rename 's/oneproterm/proterm/';
find ./ ! -path "./vendor/*" ! -path "./.git/*" -type f -name "*.php" | xargs rename 's/Oneproterm/Proterm/';

find . -type d | xargs rename 's/Oneproduct/Product/';
find . -type d | xargs rename 's/oneproduct/product/';

find ./ ! -path "./vendor/*" ! -path "./.git/*" -type f -name "*.php" | xargs rename 's/oneproduct/product/';
find ./ ! -path "./vendor/*" ! -path "./.git/*" -type f -name "*.php" | xargs rename 's/Oneproduct/Product/';

find . -type d | xargs rename 's/Oneorder/Order/';
find . -type d | xargs rename 's/oneorder/order/';

find ./ ! -path "./vendor/*" ! -path "./.git/*" -type f -name "*.php" | xargs rename 's/oneorder/order/';
find ./ ! -path "./vendor/*" ! -path "./.git/*" -type f -name "*.php" | xargs rename 's/Oneorder/Order/';

find . -type d | xargs rename 's/Onelottery/Lottery/';
find . -type d | xargs rename 's/onelottery/lottery/';

find ./ ! -path "./vendor/*" ! -path "./.git/*" -type f -name "*.php" | xargs rename 's/Onelottery/Lottery/';
find ./ ! -path "./vendor/*" ! -path "./.git/*" -type f -name "*.php" | xargs rename 's/onelottery/lottery/';


find ./ ! -path "./vendor/*" ! -path "./.git/*" -type f -name "*.php" | xargs sed -i -e "s/Oneproterm/Proterm/g";
find ./ ! -path "./vendor/*" ! -path "./.git/*" -type f -name "*.php" | xargs sed -i -e "s/oneproterm/proterm/g";

find ./ ! -path "./vendor/*" ! -path "./.git/*" -type f -name "*.php" | xargs sed -i -e "s/Oneproduct/Product/g";
find ./ ! -path "./vendor/*" ! -path "./.git/*" -type f -name "*.php" | xargs sed -i -e "s/oneproduct/product/g";

find ./ ! -path "./vendor/*" ! -path "./.git/*" -type f -name "*.php" | xargs sed -i -e "s/Oneorder/Order/g";
find ./ ! -path "./vendor/*" ! -path "./.git/*" -type f -name "*.php" | xargs sed -i -e "s/oneorder/order/g";

find ./ ! -path "./vendor/*" ! -path "./.git/*" -type f -name "*.php" | xargs sed -i -e "s/Onelottery/Lottery/g";
find ./ ! -path "./vendor/*" ! -path "./.git/*" -type f -name "*.php" | xargs sed -i -e "s/onelottery/lottery/g";