<?php
namespace app\admin\controller;


class Index extends AdminBase
{
    public function index()
    {
        return view();
    }

    public function welcome()
    {
        return '欢迎来到后台管理系统';
    }

    //退出登录
    public function logout()
    {
        //清空当前session
        session('admin',null);
        $this->redirect('login/index');
    }
}
