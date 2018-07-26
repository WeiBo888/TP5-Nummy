<?php
/**
 * Created by PhpStorm.
 * User: weibo
 * Date: 2018/7/24
 * Time: 下午4:39
 */

namespace app\index\controller;

use think\App;

class Order extends HeadController
{
    public function __construct(App $app = null)
    {
        parent::__construct($app);
        $this->model_obj = model('Goods');
        $this->getHeadMsg();
    }

    public function index()
    {
        $data = input();
        $third_level_name = model('Category')->where(['id'=>$data['third_level_id']])->value('name');
        $goods_id = $data['goods_id'];
        $goods = $this->model_obj->where(['id'=>$goods_id])->find();
        return view('',[
            'first_level_id' => $data['first_level_id'],
            'third_level_id' => $data['third_level_id'],
            'third_level_name' => $third_level_name,
            'goods' => $goods
        ]);
    }

}