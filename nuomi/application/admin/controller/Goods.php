<?php
/**
 * Created by PhpStorm.
 * User: weibo
 * Date: 2018/7/17
 * Time: 下午5:26
 */

namespace app\admin\controller;
use think\App;


class Goods extends AdminBase
{
    public function __construct(App $app = null)
    {
        parent::__construct($app);
        $this->model_obj = model('Goods');
    }

    public function index()
    {
        //获取所有商品
        $data = $this->model_obj->select();
        return view('',[
            'data' => $data
        ]);
    }
}