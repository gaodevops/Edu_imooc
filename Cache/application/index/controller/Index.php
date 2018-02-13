<?php
namespace app\index\controller;
use think\Controller;

use app\common\model\Banner;

class Index extends Controller
{
    public function index()
    {
        return view('index/homepage');
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }

    public  function BannerJson(){
        $BannerModel = new Banner();
        return $BannerModel -> BannerJsonToFile(7);
    }
}
