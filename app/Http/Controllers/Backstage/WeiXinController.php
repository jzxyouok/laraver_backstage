<?php
/**
 * Created by PhpStorm.
 * User: 123
 * Date: 2016-06-25
 * Time: 21:09
 */

namespace App\Http\Controllers\Backstage;
use App\Http\Services\WXArticleService;
use App\Models\WXArticle;
use Illuminate\Support\Facades\Input;
use Redirect;
class WeiXinController extends CommonController
{

    function index(){
        $article = WXArticle::orderBy('id','desc')->paginate(10);
        return view('Backstage.WeiXin.index')->with("info",$article);
    }


    function updateWX()
    {
        $WX = new WXArticleService();
        if( $WX->saveTodayWXArticle())
        {
          $info = "信息更新成功";
        }
        return Redirect::to('/weixin');
    }

    function deleteById(){
        $id = Input::get("id");
        $result = WXArticle::where('id', '=', $id)->delete();

        return response()->json(array(
            'status' => $result,
            'msg' => 'ok',
        ));

    }
}