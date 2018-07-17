<?php
/**
 * Created by PhpStorm.
 * User: weibo
 * Date: 2018/7/4
 * Time: 上午11:55
 */

namespace app\admin\model;

use think\Model;

class Admin extends Model
{
    public function getAllAdmin()
    {
        return $this->select();
    }
}