<?php
/**
 * 专门用来负责整个焦点图相关的业务流程的逻辑实现，
 * Created by PhpStorm.
 * User: mail
 * Date: 2018/3/5
 * Time: 18:23
 */

namespace app\model\Biz;


use app\model\Dao\Banner;

class BannerBiz
{

    /**
     * 从数据库里提取到对应的焦点图，并整理成json格式 ，
     * @param int $num
     * @return json
     */
    public function GetBannerJson($num = 5)
    {
        $list = Banner::all(function ($query) use ($num){
           $query-> where('status',1)->limit($num) ->order('order','desc');
        });
        return $list->toJson();
    }
    
}