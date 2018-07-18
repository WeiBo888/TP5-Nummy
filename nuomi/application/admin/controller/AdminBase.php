<?php
namespace app\admin\controller;

use think\App;
use think\Controller;

class AdminBase extends Controller
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
            $this->userInfo = session('admin');
        }
        return $this->userInfo;
    }

    //修改状态的方法(删除或停用)
    public function status()
    {
        //获取前端传过来的id和status值
        $data = input();
        //执行更新
        $res = $this->model_obj->save(['status' => $data['status']],['id' => $data['id']]);
        if ($res){
            return json([
                'code' => 1,
                'msg' => '修改成功'
            ]);
        }else{
            return json([
                'code' => 0,
                'msg' => '修改失败'
            ]);
        }
    }

    //登录验证
}
