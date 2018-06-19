<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "yyd".
 *
 * @property int $id
 * @property string $url 中奖号码
 * @property resource $data 中奖号码
 */
class Yyd extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'yyd';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data'], 'required'],
            [['data'], 'string'],
            [['url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'data' => 'Data',
        ];
    }
}
