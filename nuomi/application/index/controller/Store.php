<?php
/**
 * Created by PhpStorm.
 * User: weibo
 * Date: 2018/7/19
 * Time: 下午6:42
 */

namespace app\index\controller;

use think\App;

class Store extends HeadController {
    public function __construct(App $app = null)
    {
        parent::__construct($app);
        $this->model_obj = model('Store');
        $this->getHeadMsg();
    }

    public function index()
    {
        $data = input();
        $first_level_id = $data['first_level_id'];
        $third_level_id = isset($data['third_level_id']) ? $data['third_level_id'] : false;
        $category = model('Category');
//        查询指定一级目录名称
        $first_level_name = $category->getCategoryByID($first_level_id);
//        查询指定三级目录名称
        $third_level_name = $category->getCategoryByID($third_level_id);
        $price_letter = $data['price'];

        //查询包含指定三级目录的一级目录所含有的所有三级目录
        $third_data = $category->getCategoryByRootParentID($data['first_level_id']);
        if(isset($data['third_level_id'])) {
//          根据三级目录与价格查询
            $store = $this->model_obj->getStoreByCategoryAndID($third_level_id, $price_letter);
        }else{
            //根据一级目录与价格查询
            $store = $this->model_obj->getStoreByCategoryAndID($first_level_id, $price_letter);

        }
//        dump($price_letter);exit();
//        dump($store);exit();
        return view('', [
            'first_level_id' => $first_level_id,
            'third_level_id' => $third_level_id,
            'first_level_name' => $first_level_name,
            'third_level_name' => $third_level_name,
            'third_data' => $third_data,
            'store' => $store,
            'price' => $price_letter,
        ]);

    }

}