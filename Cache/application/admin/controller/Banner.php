<?php
namespace app\admin\controller;
use app\common\model\Banner as BannerModel;
use think\exception\HttpException;

use think\Request;

class Banner extends Common
{
    /**
     * 列表
     *
     * @return \think\response\View
     */
    public function json()
    {
        $BannerModel = new BannerModel();
        echo $BannerModel -> getBannerJson(7);
    }

    public  function MakeJson(){
        $BannerModel = new BannerModel();
        $json = $BannerModel -> getBannerJson(7);
        $jsonDir = SITE_PATH.'/json/';
        //文件夹
        if(!is_dir($jsonDir))
        {
            return '不存在文件夹';
        }

        //权限
        try {
            $res = file_put_contents($jsonDir .'banner.json', $json);
            if ($res) {
                return 'JSON生成成功';
            }else{
                return 'JSON生成失败';
            }
        } catch(\Exception $e) {
            return  $e->getMessage();
        }

//        echo file_put_contents(SITE_PATH.'/jso2n/banner.json', $json);
//
//        $path = SITE_PATH;
//        print_r($path);
//
////        $fp = fopen('/path/file.txt', 'w+');
////        fwrite($fp, 'your string');
////        fclose($fp);
////
////// or
//
////        file_put_contents('path/file.txt', $json);

    }
}