<?php
/**
 * Created by PhpStorm.
 * User: weibo
 * Date: 2018/7/10
 * Time: 下午5:14
 */

namespace app\common\model;


use think\Model;

class Store extends Model
{
    public function getAllStores($userInfo)
    {
        $con = [
            'bis_id' => $userInfo
        ];
        return $this->where($con)->select();
    }

    //根据商家id找商户信息
    public function getStoreByID($id){

        return $this->where(['category_id' => $id])->paginate(20);

    }

    //根据分类和价格找出商铺
    public function getStoreByCategoryAndID($category_id, $price_letter)
    {
        $price_con = $this->getPriceCondition($price_letter);
//        dump($category_id.$price_letter);exit();
        return $this->where("category_id like '%$category_id%' and avg_price $price_con")->select();
    }

    public function getPriceCondition($condition_price)
    {
        if ($condition_price == 1){
            return '< 50';
        }else if($condition_price == 2){
            return 'between 50 and 100';
        }else if($condition_price == 3){
            return 'between 100 and 200';
        }else if($condition_price == 4){
            return 'between 200 and 300';
        }else if($condition_price == 5){
            return '> 300';
        }else{
            return '> 0';
        }
    }
}
