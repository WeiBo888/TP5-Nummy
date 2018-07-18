<?php
/**
 * Created by PhpStorm.
 * User: weibo
 * Date: 2018/7/17
 * Time: 下午5:26
 */

namespace app\admin\controller;
use think\App;


class Store extends AdminBase
{
    public function __construct(App $app = null)
    {
        parent::__construct($app);
        $this->model_obj = model('Store');

    }

    //显示登录商户的所有商铺
    public function index(){
        $data = $this->model_obj->select();
        return view('',[
            'data' => $data
        ]);
    }
}