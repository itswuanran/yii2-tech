<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "onearticle".
 *
 * @property integer $id
 * @property string $title
 * @property string $image
 * @property string $author
 * @property string $author_it
 * @property string $guide_word
 * @property string $wb_img_url
 * @property integer $content_id
 * @property string $content
 */
class Onearticle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'onearticle';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content_id'], 'integer'],
            [['content'], 'string'],
            [['title', 'image', 'author', 'author_it', 'guide_word', 'wb_img_url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'image' => 'Image',
            'author' => 'Author',
            'author_it' => 'Author It',
            'guide_word' => 'Guide Word',
            'wb_img_url' => 'Wb Img Url',
            'content_id' => 'Content ID',
            'content' => 'Content',
        ];
    }
}
