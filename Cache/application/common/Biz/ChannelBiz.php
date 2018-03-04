<?php
/**
biz，business层，负责整个应用程序的相关业务流程，并用代码实现出来；
 */

namespace app\common\Biz;
use app\common\Model\Channel;
use app\common\Model\GoodsBrand;
use app\common\Model\GoodsInfo;


class ChannelBiz
{

    /**
     * 主逻辑
     * @param $channel_id
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function GetChannelContent($channel_id){
        return array(
            'Info' =>$this -> GetChannelInfo($channel_id),
            'SubChannel' =>$this -> GetSubChannelInfo($channel_id),
            'Goods' =>$this -> GetChannelGoods($channel_id),
            'Brand' =>$this -> GetChannelBrand($channel_id),
        );

    }

    /**
     * 取得栏目名
     * @param int $channel_id
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function GetChannelInfo($channel_id){
        return Channel::where('id','=',$channel_id)->find()->toArray();
    }

    //子栏目
    public function GetSubChannelInfo($channel_id){
        return Channel::where('channel_id','=',$channel_id)->select()->toArray();
    }

    //商品
    public function GetChannelGoods($channel_id){
        $goods =  GoodsInfo::where('channel_id','=',$channel_id)->select()->toArray();
        $data = array();
        foreach ($goods as $good) {
            $data[$good['show_id']][] =  $good;
        }
        return $data;
    }

    //品牌
    public function GetChannelBrand($channel_id){
        return GoodsBrand::where('channel_id','=',$channel_id)->select()->toArray();
    }



}