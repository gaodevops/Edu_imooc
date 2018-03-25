<?php
/**
 * 根据栏目的id来获取栏目的信息，子栏目的信息，商品的信息,品牌的信息，
 * Created by PhpStorm.
 * User: mail
 * Date: 2018/3/6
 * Time: 7:21
 */

namespace app\model\Biz;


use app\model\Dao\Channel;
use app\model\Dao\GoodsBrand;
use app\model\Dao\GoodsInfo;

class ChannelBiz
{

    public function GetChannelContent($channel_id)
    {
        //1.获取本栏目的信息，
        //2.获取本栏目下子栏目的信息，
        //3.获取商品名以及商品的信息，
        //4.栏目下品牌的信息，
        return array(
            'Info' => $this->GetInfo($channel_id),
            'SubChannel' => $this->GetSubChannel($channel_id),
            'Goods' => $this->GetChannelGoods($channel_id),
            'Brand' =>  $this->GetChannelBrands($channel_id),
        );

    }

    /**
     * 获取栏目信息，
     */
    public  function GetInfo($channel_id)
    {
        return Channel::where('id' , '=' , $channel_id)->find()->toArray();
    }

    /**
     * 获取子栏目的信息，
     * @param $channel_id
     */
    public function GetSubChannel($channel_id)
    {
        return Channel::where('channel_id' , '=' , $channel_id)->select()->toArray();
    }

    /**
     * 获取商品的信息，
     * @param $channel_id
     */
    public function GetChannelGoods($channel_id)
    {
        $goods =  GoodsInfo::where('channel_id' , '=' , $channel_id)->select()->toArray();
        $data = array();
        foreach ($goods as $good) {
            $data[$good['show_id']][] = $good;
        }
        return $data;
        
    }


    /**
     * 获取品牌的信息，
     * @param $channel_id
     */
    public function GetChannelBrands($channel_id)
    {
        return GoodsBrand::where('channel_id' , '=' , $channel_id)->select()->toArray();
    }


}