<?php
namespace app\index\controller;
use app\common\Biz\ChannelBiz;
use app\common\Biz\RewriteBiz;
use think\Controller;

use app\common\model\Banner;
use Driver\Cache\Redis as Redis;
use think\facade\Session;

class Index extends Controller
{
    public function index()
    {

        if (!Session::has('uid')) {
            echo "您没登录";
            exit;
        }
        $data = array();
        $data['views'] = 0;
        $data['uid'] = Session::get('uid');
        $data['username'] = Redis::get('username_'.$data['uid']);

        //这里是更新到数据库的流程
        //.....
        if (true) {
            //其实这个返回的结果就是最新的统计
            $data['views'] = Redis::incr('view_'.$data['uid']);
        }

        return view('index/homepage',$data);
    }

    public function redistest(){
        $c = Redis::get('ccc');
        var_dump($c);
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
