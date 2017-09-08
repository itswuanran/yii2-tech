<?php

namespace tech\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use kartik\markdown\Markdown;

/**
 * 该model对应数据库表 "blog".
 *
 * @property integer $id
 * @property string $title 标题
 * @property string $content 内容
 * @property integer $addtime 创建时间
 * @property integer $modtime 修改时间
 * @property integer $status 状态
 * @property string $attr 备注信息
 */
class Blog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'required'],
            [['content'], 'string'],
            [['addtime', 'modtime', 'status'], 'integer'],
            [['title'], 'string', 'max' => 64],
            [['attr'], 'string', 'max' => 1024]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'content' => '内容',
            'addtime' => '创建时间',
            'modtime' => '修改时间',
            'status' => '状态',
            'attr' => '备注信息',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['addtime', 'modtime'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['modtime'],
                ],
            ],
        ];
    }

    public function getShortUrl()
    {
        return '/blog/' . $this->id . '.html';
    }

    public function getHtmlContent()
    {
        return Markdown::convert($this->content);
    }

    public function getHtmlSummary()
    {
        $htmlContent = $this->getHtmlContent();
        $start = strpos($htmlContent, '<p>');
        $end = strpos($htmlContent, '</p>', $start);
        return strip_tags(substr($htmlContent, $start, $end - $start + 4));
    }

    public function getAuthor()
    {
        return '';
    }

    /**
     * 查看次数
     */
    public function addViewCount()
    {
        $key = "blog_view_{$this->id}";
        if (!Yii::$app->session->has($key)) {
            Yii::$app->session->set($key, 1);
            $this->views++;
            $this->save(false);
        }
    }
}
