<?php
/**
 * Created by PhpStorm.
 * User: weibo
 * Date: 2018/7/4
 * Time: 下午5:42
 */
namespace app\merchant\controller;

use app\common\controller\Base;
use think\App;

class Login extends Base{

    private $business;

    public function __construct(App $app = null)
    {
        if (session('userInfo')){
            $this->redirect('index/index');
        }
        $this->business = model('Business');
    }

    public function index()
    {
        return view();
    }

    public function checkLogin()
    {
        $data = input();
        //校验验证码
        $captcha = $data['verifyCode'];
        if (!captcha_check($captcha)){
            $this->error('验证码错误');
        }else{
            $username = trim($data['username']);
            $password = md5(trim($data['password']));
            $res = $this->business->where(['username' => $username, 'password' => $password])->find();
            if (!$res){
                $this->error('用户名或密码不存在');
            }else if ($res['status'] == 1){
                //存储session用户名
                session('userInfo', $res);
                $this->success('登录成功','index/index');
            }else{
                $this->error('该用户已被管理员禁止');
            }
        }
    }
    //退出登录的方法不要写在这里,方式重定向302错误发生
}