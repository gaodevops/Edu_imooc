<?php
namespace app\index\controller;

use Driver\Cache\Redis;
use think\facade\Session;

class Index
{
    public function index()
    {
//        uid
//        nickname
//        views 0
        $data = array(
            'uid' => Session::get('uid'),
            'views' => 0,
            'username' => '游客',
        );
        if (!empty($data['uid'])){
            $data['username'] = Redis::get('username_'.$data['uid']);
            //统计结果应该是先去数据库里去检索，这里咱们不检索了，
            $data['views'] = Redis::incr('view_'.$data['uid']);
            $data['userinfo'] = Redis::hget('user_'.$data['uid']);

//            Redis::hincrby('user_'.$data['uid'],'age');

        }
        return view('index/home',$data);
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
}
