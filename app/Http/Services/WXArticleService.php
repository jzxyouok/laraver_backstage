<?php
/**
 * Created by PhpStorm.
 * User: Jandou
 * Date: 2016-06-26
 * Time: 0:33
 */

namespace App\Http\Services;
use App\Models\WXArticle;


class WXArticleService  {


    /**
     * 保存当天爬取的微信文章
     * @return  boolean
     */
    public function saveTodayWXArticle(){
        $urlArray[0] = "http://top.aiweibang.com/u/36297";  // test
        $urlArray[1] = "http://top.aiweibang.com/u/275614";  //test
        $model = new WXArticle();
        $last_time = $model::orderBy('id','desc')->take(1)->get();
        $last_time = $last_time[0]->time;
        $now = date("Y-m-d 00:00:00");
        $oneDay = 24*60*60;
        if((strtotime($now) - strtotime($last_time)) > $oneDay)
        {
            $info = $this->getTodayNewWXArticle($urlArray);
            $wxArticle = new WXArticle();
            return $wxArticle->insert($info,'wx_article');
        }
        return false;
    }

    /**
     * @param $urlArray 爬取“爱微帮网”里面的地址
     * @return  array
     */
    public function getTodayNewWXArticle($urlArray){

        $count = 0;
        for ($z = 0; $z < count($urlArray); ++$z) {
            $url = $urlArray[$z];
            if ($url != NULL) {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 100);
                $str = curl_exec($ch);
                //正则表达式进行匹配
                $title = '/<a href=\"http:\/\/www.aiweibang.com\/yuedu\/([\s\S]*?)<\/a>/';
                $time = '/height: 20px\;\">([\s\S]*?)<\/span>/';
                $countRead = '/阅读数\"> <\/span>([\s\S]*?)\n/';
                $countGood = '/点赞数\"> <\/span>([\s\S]*?)\n/';
                preg_match_all($title, $str, $title);
                preg_match_all($time, $str, $time);
                preg_match_all($countRead, $str, $countRead);
                preg_match_all($countGood, $str, $countGood);
                $countRead[1] = array_slice($countRead[1], 0, 16);

                for ($i = 0; $i < count($time[1]); ++$i) {
                    if ($time[1][$i] == "")
                        $time[1][$i] = $time[1][$i - 1];
                    if (date("Y-m-d", strtotime("-1 day")) == $time[1][$i])  //获取昨天的数据
                    {
                        $info[$count++] = array(
                            'title' => $title[0][$i],
                            'time' => $time[1][$i],
                            'readNum' => $countRead[1][$i],
                            'startNum' => $countGood[1][$i],
                        );
                    }
                }
                if ($info == NULL) continue;
            }
        }
        return $info;
    }
}