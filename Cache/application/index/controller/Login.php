<?php
namespace app\index\controller; 
use think\Controller; 
use Driver\Cache\Redis as Redis;
use think\facade\Session;

class Login extends Controller
{
    public function index()
    {
        if (Session::has('uid')) {
            echo "您已经登录过了";
            exit;
        }

        if ($_POST) {
            Session::set('uid',$_POST['uid']);
            //uid去数据库里查出用户昵称来。假如叫张三
            Redis::set('username_'.$_POST['uid'],'张三疯');

            echo '登录成功，您的UID为'.$_POST['uid'];
            exit;
        }

        return view('login/login');
    }
 
}
