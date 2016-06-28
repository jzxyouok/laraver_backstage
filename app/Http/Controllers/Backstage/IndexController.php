<?php
/**
 * Created by PhpStorm.
 * User: 123
 * Date: 2016-06-25
 * Time: 14:47
 */

namespace App\Http\Controllers\Backstage;
use App\Http\Controllers\Backstage\CommonController;

class IndexController extends CommonController {

    function index(){
        $system_name =php_uname('s');
        if($system_name == "Windows NT")
        {
            $info = "未完成";
        }
        else{
            $fp = popen('top -b -n 2 | grep -E "^(Cpu|Mem|Tasks)"',"r");//获取某一时刻系统cpu和内存使用情况
            $rs = "";
            while(!feof($fp)){
                $rs .= fread($fp,1024);
            }
            pclose($fp);
            $sys_info = explode("\n",$rs);
            $tast_info = explode(",",$sys_info[0]);//进程 数组
            $cpu_info = explode(",",$sys_info[0]);  //CPU占有量  数组
            $mem_info = explode(",",$sys_info[0]); //内存占有量 数组

            //正在运行的进程数
            dump($tast_info);die;
            $tast_running = trim(trim($tast_info[1],'running'));


            //CPU占有量
            $cpu_usage = trim(trim($cpu_info[0],'Cpu(s): '),'%us');  //百分比

            //内存占有量
            $mem_total = trim(trim($mem_info[0],'Mem: '),'k total');
            $mem_used = trim($mem_info[1],'k used');
            $mem_usage = round(100*intval($mem_used)/intval($mem_total),2);  //百分比

            $sys_list = array(
                'cpu_use'       => $cpu_usage,
                'mem_use'       => $mem_usage,
                'tast_use'      => $tast_running,
            );
            dd($sys_list);




        }

        return view('Backstage.Index.index');
    }
}