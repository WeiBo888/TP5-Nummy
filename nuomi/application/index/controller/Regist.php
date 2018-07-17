<?php
/**
 * Created by PhpStorm.
 * User: weibo
 * Date: 2018/6/26
 * Time: 上午10:30
 */

namespace app\index\controller;

use think\Controller;

class Regist extends Controller{
    //注册页面首页
    public function index()
    {
        return view();
    }

    //获取注册信息进行验证和存储
    public function save()
    {
        $data = input('post.');
        //数据校验
        $validate = validate('User');
        $res = $validate->scene('add')->check($data);
        if (!$res){
            $this->error($validate->getError());
        }else{
            //执行添加操作
            $user = model('User');
            //将密码进行MD5转化
            $data['password'] = md5($data['password']);
            $res = $user->add($data);
            if (!$res){
                $this->error('注册失败');
            }else{
                $this->success('注册成功','login/index');
            }
        }
    }

    //检测用户名是否可用
    public function checkUserName()
    {
        $username = input('post.username');
        //执行查询
        $res = model('User')->checkUserName($username);
        if ($res){
            //用户名已存在,不可用
            return json(['status' => 0]);
        }else{
            //用户不存在
            return json(['status' => 1]);
        }
    }
}