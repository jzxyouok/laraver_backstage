<?php
/**
 * Created by PhpStorm.
 * User: 123
 * Date: 2016-06-25
 * Time: 22:59
 */

namespace App\Models;
use DB;

class WXArticle extends CommonModel{

    protected $table="wx_article";
    protected $fillable = ['title','time','startNum','readNum'];

    /**
     * 批量导入
     * @param $array
     */


}