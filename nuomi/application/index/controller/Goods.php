<?php
/**
 * Created by PhpStorm.
 * User: weibo
 * Date: 2018/7/23
 * Time: 下午9:49
 */

namespace app\index\controller;


use think\App;

class Goods extends HeadController
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
        $goods = $this->model_obj->getGoodsByStoreID($data['store_id']);
        $category = explode(',',model('Store')->where(['id' => $data['store_id']])->value('category_id'))[2];
        $third_level_category = model('Category')->where(['id' => $category])->find();
        $store_msg = model('Store');
        $store = $store_msg->where(['id' => $data['store_id']])->find();
        if($store['open_time'] == '00:00:00 - 00:00:00'){
            $store['open_time'] = '全天24小时营业';
        }

//        dump($store);exit();
        return view('',[
            'goods' => $goods,
            'store' => $store,
            'first_level_id' => $data['first_level_id'],
            'first_level_name' => $data['first_level_name'],
            'third_level_category' => $third_level_category,
        ]);
    }
}