<?php
namespace app\index\controller;
use app\common\Biz\ChannelBiz;
use app\common\Biz\RewriteBiz;
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


    /**
     * 后台生成lovelife 模块
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function lovelifetohtml(){
        $channel_ids = array(1,2,3,4);
        $channel_data =  array();
        $ChannelBiz = new ChannelBiz();
        foreach ($channel_ids as $channel_id) {
            array_push($channel_data,$ChannelBiz ->GetChannelContent($channel_id));
        }


        $RewriteBiz = new RewriteBiz();
        $result = $RewriteBiz ->ToHtml('channel' , $channel_data);
        if ($result){
            echo '成功';
        }else{
            echo '失败';
        }


//        return view('index/homepage');
//        $BannerModel = new Channel.php();
//        return $BannerModel -> GetChannelInfo(1);
    }
}
