<?php
namespace app\merchant\controller;

use app\common\controller\Base;

class Index extends Base
{
//    商家登录后显示的首页
    public function index(){
        $this->assign('userInfo', session('userInfo'));
        return view();
    }
    public function welcome()
    {
//        phpinfo();
        return view();
    }

    public function logout()
    {
        //清空当前session
        session('userInfo',null);
        $this->redirect('login/index');
    }
}
