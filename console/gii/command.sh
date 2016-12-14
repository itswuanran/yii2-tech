#!/usr/bin/env bash
yes y | php yii gii/model --tableName="order" --modelClass="Order" --db="db" --ns="common\models"
yes y | php yii gii/model --tableName="product" --modelClass="Product" --db="db" --ns="common\models"
yes y | php yii gii/model --tableName="community" --modelClass="Community" --db="db" --ns="common\models"
yes y | php yii gii/model --tableName="city" --modelClass="City" --db="db" --ns="common\models"
yes y | php yii gii/model --tableName="user" --modelClass="User" --db="db" --ns="common\models"