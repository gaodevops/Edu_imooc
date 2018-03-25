<?php
/**
 * Created by PhpStorm.
 * User: wangweiqiang
 * Date: 2018/3/25
 * Time: 下午2:35
 */

namespace app\admin\controller;


use Driver\Cache\Redis;
use think\Controller;

class Miaosha extends Controller
{
    public function saveMiaosha()
    {
        //取得商品2的
        $sid = 4;

        $cache_ms_status = 'ms_status_'.$sid;
        $cache_ms_uids = 'ms_'.$sid;

        Redis::set($cache_ms_status,1);

        for ($i=0; $i<= Redis::llen($cache_ms_uids) ;$i++){
            $uid = Redis::rpop($cache_ms_uids);

            //对此uid进行入库

            echo "用户" .$uid .'已经成功秒杀了商品' . $sid . "<br>";
        }


    }

}