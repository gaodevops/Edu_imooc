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
            if (empty($data['userinfo'])){
                $data['userinfo'] = array(
                    'username' => '',
                    'sex' => '',
                    'city' => '',
                    'age' => '',
                    'color' => '',
                    'love' => '',
                );
            }

//            Redis::hincrby('user_'.$data['uid'],'age');


            //jihe
            $data['bei'] = Redis::smembers('goods_bei');
            $data['nan'] = Redis::smembers('goods_nan');
            $data['goods_score_num'] =Redis::zsize('goods_score');
            $data['goods_score'] = Redis::zrevrange('goods_score',0,4,true);

        }
        return view('index/home',$data);
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }

    //两个缓存  如商品3
    // ms_status_3 为1时秒杀结束
    // ms_3 秒杀uid列表

    public function miaosha()
    {
        $uid = input('post.uid');
        $sid = input('post.sid');
        $cache_ms_status = 'ms_status_'.$sid;
        $cache_ms_uids = 'ms_'.$sid;
        if (Redis::get($cache_ms_status) == 1) {
            return array(
                'code' => 0,
                'msg' => '秒杀结束',
            );
        }

        $number = Redis::llen($cache_ms_uids);

        if ($number >1) {
            //标记秒杀是否已经结束
            Redis::set($cache_ms_status,1);
            return array(
                'code' => 0,
                'msg' => '秒杀结束',
            );
        }
        Redis::lpush($cache_ms_uids,$uid);
        return array(
            'code' => 1,
            'msg' => '秒杀成功',
        );

    }
}
