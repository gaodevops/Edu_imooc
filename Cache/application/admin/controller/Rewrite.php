<?php
/**
 * 从数据库里提取记录，并且将其生成为，对应的静态文本格式，
 * Created by PhpStorm.
 * User: mail
 * Date: 2018/3/5
 * Time: 18:18
 */

namespace app\admin\controller;


use app\model\Biz\BannerBiz;
use app\model\Biz\ChannelBiz;
use app\model\Biz\RewriteBiz;
use think\Controller;

class Rewrite extends Controller
{
    /**
     * 检索焦点图数据，并将其生成为json格式，
     */
    public  function BannerToJson(){
        //1.我需要从数据库里提取到对应的焦点图的数据，
        $BannerModel = new  BannerBiz();
        $json = $BannerModel->GetBannerJson(7);

        //2.把数据进行整理，并生成为这份格式，
        $RewriteModel =new RewriteBiz();
        $result = $RewriteModel->ToJson($json);
        if ($result){
            echo "焦点图生成成功";
        }else{
            echo "焦点图生成失败";
        }
    }


    /**
     * 栏目的内容，生成为html，
     */
    public function ChannelToHtml(){
        //1.遍历所有的栏目，提取栏目的数据，
        $channel_ids = array(1,2,3,4 );
        $ChannelBiz = new ChannelBiz();
        $channel_data =array();
        foreach ($channel_ids as $channel_id) {
            array_push($channel_data , $ChannelBiz->GetChannelContent($channel_id));
        }


        //2.将数据保存到html中，

        $RewriteBiz = new RewriteBiz();
        $res = $RewriteBiz -> ToHtml('channel',$channel_data);
        if ($res){
            echo '栏目生成成功';
        }else{
            echo '栏目生成失败';
        }

    }



}










