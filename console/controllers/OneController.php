<?php

/**
 * 抓取一个文章 信息
 */
namespace console\controllers;

use common\models\Onearticle;
use yii\console\Controller;

class OneController extends Controller
{
    /**
     * 批处理脚本的实现
     * 一次取50
     */
    public function actionArticle()
    {
        $min = 0;
        $max = 2500;
        $batchnum = 50;
        $j = 0;
        for ($id = $min; $id <= $max + $batchnum; $id += $batchnum) {
            $url = [];
            for ($i = $id; $i < $id + $batchnum; $i++) {
                $url[] = 'http://v3.wufazhuce.com:8000/api/essay/' . $i;
            }
            $datas = static::multiRequest($url);
            file_put_contents("$id.one", $datas);
            foreach ($datas as $data) {
                $res = json_decode($data, true);
                if (isset($res['res']) && $res['res'] == 0) {
                    echo $j++ . "done" . PHP_EOL;
                    $ret = $res['data'];
                    $one = new Onearticle();
                    $one->content_id = $ret['content_id'];
                    $one->title = $ret['hp_title'];
                    $one->content = $ret['hp_content'];
                    $one->author = $ret['hp_author'];
                    $one->author_it = $ret['auth_it'];
                    $one->guide_word = $ret['guide_word'];
                    $one->wb_img_url = $ret['wb_img_url'];
                    $one->save(false);
                }
            }
        }
    }

    /**
     * @param $urls
     * @return array
     */
    public static function multiRequest($urls)
    {
        $mh = curl_multi_init();
        $curl_array = array();
        foreach ($urls as $i => $url) {
            $curl_array[$i] = curl_init($url);
            curl_setopt($curl_array[$i], CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl_array[$i], CURLOPT_URL, $url);
            curl_setopt($curl_array[$i], CURLOPT_HEADER, false);
            curl_setopt($curl_array[$i], CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl_array[$i], CURLOPT_SSL_VERIFYPEER, false);
            curl_multi_add_handle($mh, $curl_array[$i]);
        }
        $active = null;
        do {
            curl_multi_exec($mh, $active);
        } while ($active > 0);
        $response = [];
        foreach ($urls as $i => $url) {
            $response[$url] = curl_multi_getcontent($curl_array[$i]);
        }
        foreach ($urls as $i => $url) {
            curl_multi_remove_handle($mh, $curl_array[$i]);
        }
        curl_multi_close($mh);
        return $response;
    }
}
