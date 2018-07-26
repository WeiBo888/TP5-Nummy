<?php
/**
 * Created by PhpStorm.
 * User: weibo
 * Date: 2018/7/20
 * Time: 上午11:23
 */

namespace app\index\controller;


use think\Controller;

class HeadController extends Controller
{
    public function getHeadMsg()
    {
        $city = model('Region');
        //获取热门城市信息
        $cities = $city->getHotCities();
        //获取默认城市
        $defaultCity = $city->getDefaultCity();
        //获取列表中的信息
        $category = model('Category');
        $categories = $category->getAllCategories();

        //整理数据
        $manuData = [];
        $seManuData = [];
        $thManuData = [];
        foreach ($categories as $item) {
            //找出一级分类
            if ($item['root_parent_id'] == 0 && $item['parent_id'] == 0) {
                //向数组中加新元素
                $manuData[] = [
                    'id' => $item['id'],
                    'title' => $item['name'],
                ];
            }

//            找出二级分类
            if ($item['root_parent_id'] == $item['parent_id'] && $item['parent_id'] != 0) {
                for ($i = 0; $i < count($manuData); $i++) {
                    if ($manuData[$i]['id'] == $item['parent_id']) {
                        $seManuData[] = [
                            'id' => $item['id'],
                            'parent_id' => $item['parent_id'],
                            'title' => $item['name']
                        ];
                    };
                }

            }

            //找出三级分类
            if ($item['parent_id'] != $item['root_parent_id']) {
                for ($i = 0; $i < count($seManuData); $i++) {
                    if ($seManuData[$i]['id'] == $item['parent_id']) {
                        $thManuData[] = [
                            'id' => $item['id'],
                            'parent_id' => $item['parent_id'],
                            'title' => $item['name']
                        ];
                    }
                }
            }
        }
//        dump($thManuData);
        //从session中读取用户名
        $username = session('username');
//        return view('', [
//            'userInfo' => $username,
//            'cities' => $cities,
//            'defaultCity' => $defaultCity,
//            'data' => $categories,
//            'manuData' => $manuData,
//            'seManuData' => $seManuData,
//            'thManuData' => $thManuData
//        ]);
        $this->assign('userInfo',$username);
        $this->assign('cities',$cities);
        $this->assign('defaultCity',$defaultCity);
        $this->assign('manuData',$manuData);
        $this->assign('seManuData',$seManuData);
        $this->assign('thManuData',$thManuData);
    }
}