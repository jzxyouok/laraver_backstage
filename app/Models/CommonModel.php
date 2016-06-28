<?php
/**
 * Created by PhpStorm.
 * User: Jandou
 * Date: 2016-06-25
 * Time: 23:44
 */

namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Model;

class CommonModel extends Model {


    /**
     * 批量导入函数
     * @param $array 要批量导入的数据
     * @param $table 导入的目标表
     * @return mixed
     */
    public function insert($array,$table){

        $array = $this->add_created_date($array);
        return DB::table($table)->insert($array);
    }


    /**
     * 插入创建时间
     * @param $array 要添加创建时间的数据
     * @return mixed
     */
    protected function add_created_date($array){
        for($i=0;$i<count($array);++$i)
        {
            $array[$i]['created_at'] = date("Y-m-d H:i:s");
        }
        return $array;
    }
}