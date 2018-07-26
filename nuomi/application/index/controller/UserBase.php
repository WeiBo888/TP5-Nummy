<?php
/**
 * Created by PhpStorm.
 * User: weibo
 * Date: 2018/7/24
 * Time: 下午5:03
 */

namespace app\index\controller;


use think\App;

class UserBase extends HeadController
{
    public $model_obj;
    public $userInfo;
    public function __construct(App $app = null)
    {
        parent::__construct($app);
        //登录验证
        $this->checkLogin();
        $this->assign('userInfo',$this->userInfo);
    }

    public function checkLogin()
    {
        if (!$this->getUserInfo()){
            //跳转到登录页
            $this->redirect('login/index');
        }
    }

    //获取用户信息
    public function getUserInfo()
    {
        if (!$this->userInfo){
            $this->userInfo = session('user');
        }
        return $this->userInfo;
    }
}