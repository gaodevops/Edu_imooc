<?php


namespace app\index\controller;


use Driver\Cache\Redis;
use think\Controller;
use think\facade\Session;

class Login extends Controller
{

    public function index()
    {
        if (Session::has('uid')){
            echo '你已经登陆过了';
//            Session::destroy();
            exit;
        }

        if ($_POST){
            Session::set('uid',$_POST['uid']);
            //从数据库里查出对应uid的昵称
            $nickname = '张四疯';
            //把昵称保存在缓存里，
            Redis::set('username_'.$_POST['uid'],$nickname);
            echo '登陆成功，您的uid为，'.$_POST['uid'].',您的名字为'.$nickname;
            exit;
        }



        return view('login/login');
    }


    public function userinfo()
    {
        if ($_POST){
            //给用户添加资料，
            $uid = Session::get('uid');
            //info_name
            //info_value
            Redis::hset('user_'.$uid,$_POST['info_name'],$_POST['info_value']);
            echo '成功添加';
            exit;

        }

        return view('login/userinfo');
    }

}