<?php
namespace app\common\model;

class Banner extends Common
{

    /**
     * 返回前n条状态为1的记录并按order降序
     * @param num int
     * @return JSON
     */
    public function GetBannerJson($num = 5)
    {
        $list = self::all(function($query) use ($num){
            $query->where('status', 1)->limit($num)->order('order', 'desc');
        });
        return $list->toJson();
    }

    public function BannerJsonToFile($num){
        file_put_contents('json/banner1.json',$this->GetBannerJson($num));
    }




}