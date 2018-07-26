<?php
/**
 * Created by PhpStorm.
 * User: weibo
 * Date: 2018/6/26
 * Time: 上午11:24
 */
namespace app\index\controller;

use think\Controller;

class Login extends Controller{
    public function index()
    {
            return view();
    }

    //登录
    public function login()
    {
            $data = input('post.');
            //创建一个类的对象
            $validate = validate('User');
            //实际运用类的方法
            $res = $validate->scene('login')->check($data);
            if (!$res) {
                $this->error($validate->getError());
            } else {
                $res = model('User')->checkUserName($data['username']);
                if (!$res) {
                    return json(['status' => 0, 'message' => '用户名不存在']);
                } else if ($res['password'] != md5($data['password'])) {
                    return json(['status' => 0, 'message' => '密码错误']);
                } else {
                    //将用户名存到session
                    session('user', $res['username']);
                        return json(['status' => 1]);

                }
            }
    }

    //清空session
    public function logout()
    {
        //清空当前session
        session('user',null);
        //页面跳转到首页
        $this->redirect('index/index');
    }
}