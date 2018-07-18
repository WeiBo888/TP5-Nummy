<?php
/**
 * Created by PhpStorm.
 * User: weibo
 * Date: 2018/7/18
 * Time: 上午9:42
 */

namespace app\admin\controller;


use think\App;

class Login extends AdminBase
{
    public function __construct(App $app = null)
    {
        $this->model_obj = model('Admin');
    }

    public function index()
    {
        return view();
    }

    public function checkLogin()
    {
        $data = input();
        $username = trim($data['username']);
        $password = md5(trim($data['password']));
        $res = $this->model_obj->where(['username' => $username, 'password' => $password])->find();
        if (!$res){
            $this->error('用户名或密码不存在');
        }else if ($res['status'] == 1){
            //存储session用户名
            session('admin', $res);
            $this->success('登录成功','index/index');
        }else{
            $this->error('该用户已被管理员禁止');
        }
    }
}