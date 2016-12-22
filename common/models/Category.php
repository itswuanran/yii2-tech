<?php

namespace common\models;

use Yii;
use yii\caching\TagDependency;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use common\traits\AttrTrait;
use yii\helpers\ArrayHelper;

/**
 * 该model对应数据库表 "category".
 *
 * @property integer $id
 * @property  string $name 名称
 * @property integer $pid
 * @property integer $type 类型
 * @property integer $status 状态
 * @property integer $addtime 创建时间
 * @property integer $modtime 修改时间
 * @property string $attr 扩展
 */
class Category extends ActiveRecord
{
    use AttrTrait;

    private static $categorys = null;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'type', 'status', 'addtime', 'modtime'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['attr'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '分类名称',
            'pid' => '父级分类',
            'type' => '类型',
            'status' => '状态',
            'addtime' => '创建时间',
            'modtime' => '修改时间',
            'attr' => '扩展',
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

    /**
     * 获取所有分类Model
     * @return mixed|null
     * @throws \Exception
     */
    public static function getCategoryList()
    {
        if (is_null(self::$categorys)) {
            $dep = new TagDependency(['tags' => 'category']);
            self::$categorys = Category::getDb()->cache(function ($db) {
                $data = [];
                $categorys = self::getAllCategorys();
                foreach ($categorys as $category) {
                    $data[$category->id] = $category;
                }
                return $data;
            }, '', $dep);
        }
        return self::$categorys;
    }

    /**
     * 获取层级分类
     * @param $pid
     * @return array
     */
    public static function getCategoryByPid($pid)
    {
        $categorys = self::getCategoryList();
        $data = [];
        foreach ($categorys as $category) {
            if ($category->pid == $pid) {
                $data[] = $category;
            }
        }
        return $data;
    }

    /**
     * 获取分类展示树形结构数据
     * @return array
     */
    public static function getCategoryTree()
    {
        $buffer = $treeData = $treeDict = [];
        $categorys = Category::getCategoryList();
        $first = [];
        foreach ($categorys as $category) {
            if ($category->pid == 0) {
                $first[] = $category->id;
            }
            $treeDict[$category->pid][] = $category->id;
        }
        foreach ($first as $value) {
            $treeData[] = self::generateTree($treeDict, $value, $buffer);

        }
        return $treeData;
    }

    /**
     * fancyTree所需Array结构
     * @param $data
     * @param $key
     * @param $buffer
     * @return array
     */
    public static function generateTree($data, $key, &$buffer)
    {
        $categorys = Category::getCategoryList();
        $category = ArrayHelper::getValue($categorys, $key);
        $tree = array(
            'title' => $category ? $category->name : '',
            'key' => $category ? $category->id : 0,
            'children' => [],
        );
        if (isset($buffer[$key])) {
            return $tree;
        }
        if (!empty($data[$key])) {
            foreach ($data[$key] as $subkey) {
                $tree['children'][] = self::generateTree($data, $subkey, $buffer);
            }
        }
        return $tree;
    }

    /**
     * 获取分类下所有子分类的ids
     * @param $id
     * @return array
     */
    public static function getChildrenIds($id)
    {
        $categorys = Category::getCategoryList();
        foreach ($categorys as $category) {
            if (!isset($pid2ids[$category->pid])) {
                $pid2ids[$category->pid] = [];
            }
            $pid2ids[$category->pid][] = $category->id;
        }
        $pids = [$id];
        $ids = $pids;
        while ($pids) {
            $id = [];
            foreach ($pids as $pid) {
                if (isset($pid2ids[$pid])) {
                    $id = $pid2ids[$pid];
                    $ids = array_merge($ids, $id);
                }
            }
            $pids = $id;
        }
        return $ids;
    }

    /**
     * 获取所有一级分类
     * @return array
     */
    public static function getTopCategorys()
    {
        return self::getCategoryByPid(0);
    }

    /**
     * 获取自身的一级分类
     * @param
     * @return int
     */
    public function getTopid()
    {
        return self::getTopCategoryid($this->id);
    }

    /**
     * 获取一级分类
     * @param $categoryid
     * @return int
     */
    public static function getTopCategoryid($categoryid)
    {
        $categorys = self::getCategoryList();
        $category = ArrayHelper::getValue($categorys, $categoryid);
        if (!$category) {
            return 0;
        }
        while ($category->pid) {
            $category = ArrayHelper::getValue($categorys, $category->pid);
        }
        return $category ? $category->id : 0;
    }

    /**
     * 获取三级 二级 一级的分类id
     * @return array|null
     */
    public function getCategoryIds()
    {
        $categorys = self::getCategoryList();
        $category = ArrayHelper::getValue($categorys, $this->pid);
        if (empty($category) || $category->pid == 0) {
            return null;
        }
        $data = [
            'categoryid' => $this->id,
            'categoryid2' => $this->pid,
            'categoryid1' => $category->pid,
        ];
        $categorys = ArrayHelper::map($categorys, 'id', 'name');
        $data['categorys'] = $categorys;
        if (!isset($categorys[$data['categoryid1']])) {
            $categorys[$data['categoryid1']] = '未定义分类(1)';
        }
        if (!isset($categorys[$data['categoryid2']])) {
            $categorys[$data['categoryid2']] = '未定义分类(2)';
        }
        if (!isset($categorys[$data['categoryid']])) {
            $categorys[$data['categoryid']] = '未定义分类(3)';
        }
        return $data;
    }

    public static function getAllCategorys()
    {
        return self::find()->all();
    }

    /**
     * 修改数据缓存失效
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        TagDependency::invalidate(Yii::$app->cache, 'category');
    }

    /**
     * 删除数据缓存失效
     */
    public function afterDelete()
    {
        parent::afterDelete();
        TagDependency::invalidate(Yii::$app->cache, 'category');
    }

}
