<?php
/**
 * Created by PhpStorm.
 * User: Jandou
 * Date: 2016-06-26
 * Time: 0:33
 */

namespace App\Http\Services;
use App\Models\WXArticle;
use App\Models\WXList;
use Mail;
class WXArticleService  {


    /**
     * 保存当天爬取的微信文章
     * @return  boolean
     */
    public function saveTodayWXArticle(){
        $urlArray = WXList::where('status' ,'=','1')->select('name', 'url','id')->get();
        $model = new WXArticle();
        $this->getTodayNewWXArticle($urlArray);
        return true;

        return false;
    }

    /**
     * @param $urlArray 爬取“爱微帮网”里面的地址
     * @return  array
     */
    public function getTodayNewWXArticle($urlArray){

        for ($z = 0; $z < count($urlArray); ++$z) {
            $wxArticle = new WXArticle();
            $count = 0;
            $info = array();
            $url = $urlArray[$z]->url;
            $wx_id = $urlArray[$z]->id;
            $check = $wxArticle::where('wx_id','=',$wx_id)->orderBy('time','desc')->take(1)->select('time')->get();
            if(empty($check))
            {
                $last_update_time = date("Y-m-d", strtotime("-1 day"));
            }
            else{
                $last_update_time = $wxArticle::where('wx_id','=',$wx_id)->orderBy('time','desc')->take(1)->select('time')->get();
                $last_update_time = $last_update_time[0]->time;
            }
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
                    if (strtotime($time[1][$i]) - strtotime($last_update_time) > 0)  //获取昨天的数据
                    {
                        if ($count > 15) break;
                        $info[$count++] = array(
                            'title' => $title[0][$i],
                            'time' => $time[1][$i],
                            'readNum' => $countRead[1][$i],
                            'startNum' => $countGood[1][$i],
                            'belong' => $urlArray[$z]->name,
                            'wx_id' => $wx_id,
                        );
                    }
                }
                if (!empty($info)) {
                    $wxArticle->insert($info, 'wx_article');
                    unset($info);
                }
                else {
                    unset($info);
                }
            }
        }
        return true;
    }


    /**
     * 编辑好发送邮件
     */
    function editEmail(){
        $info = $this->getTodayArticle();
        $data=['info'=>$info];
        $flag = Mail::send('Backstage.Index.email',$data ,function($message){

            $message->from("13750059992@163.com");
            $array = array(
                0   => '809781809@qq.com',
                1 => '757410523@qq.com',

            );
            $message->to($array)->subject('来之Jandou的微信统计');
        });
       return $flag;
    }


    /**
     * 提取当天抓取的文章
     */

    public function getTodayArticle(){
        $today = date("Y-m-d",strtotime('-1day'));
        $todayArticles = WXArticle::where('created_at','>',$today)->select('title', 'belong','readNum')->get();
    
        return $todayArticles;
    }
}