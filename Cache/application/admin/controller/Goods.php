<?php
/**
 * Created by PhpStorm.
 * User: wangweiqiang
 * Date: 2018/3/25
 * Time: 下午3:24
 */

namespace app\admin\controller;


use Driver\Cache\Redis;
use think\Controller;

class Goods extends Controller
{

    public function setgoods()
    {

        if ($_POST){
            Redis::sadd('goods_'.input('post.area'),input('post.goods'));
            echo '成功添加';
            exit;

        }

        return view('goods/goods');

    }


    public function showGoodsDiff()
    {
        echo '北方有专供'.Redis::scard('goods_bei').'种，其中专享的有:';
        var_dump(Redis::sdiff('goods_bei','goods_nan'));
        echo '南方有专供'.Redis::scard('goods_nan').'种，其中专享的有:';
        var_dump(Redis::sdiff('goods_nan','goods_bei'));
        echo '所有的专供有:';
        var_dump(Redis::sunion('goods_nan','goods_bei'));

    }
}