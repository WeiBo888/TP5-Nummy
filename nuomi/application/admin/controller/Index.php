<?php
namespace app\admin\controller;

use app\common\controller\Base;

class Index extends Base
{
    public function index()
    {
        return view();
    }

    public function welcome()
    {
        return '欢迎来到后台管理系统';
    }
}
