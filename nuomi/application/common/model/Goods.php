<?php
/**
 * Created by PhpStorm.
 * User: weibo
 * Date: 2018/7/16
 * Time: 下午3:14
 */

namespace app\common\model;


use think\Model;

class Goods extends Model
{
    public function getAllGoods($userInfo)
    {
        $con = [
            'bis_id' => $userInfo
        ];
        return $this->where($con)->select();
    }
}