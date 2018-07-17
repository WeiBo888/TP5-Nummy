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
}
