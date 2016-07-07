<?php
/**
 * Created by PhpStorm.
 * User: 123
 * Date: 2016-06-25
 * Time: 14:47
 */

namespace App\Http\Controllers\Backstage;
use App\Models\WXArticle;
use Mail;
use App\Http\Services\WXArticleService;

class IndexController extends CommonController {

    function index(){

//        $test = new WXArticleService();
//        $info =$test->getTodayArticle();

        return view('Backstage.Index.index');
    }


    function sendEmails(){
        $WX = new WXArticleService();
        $flag = $WX->editEmail();
        if($flag){
            echo '发送邮件成功，请查收！';
        }else{
            echo '发送邮件失败，请重试！';
        }
    }
}