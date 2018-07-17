<?php
/**
 * Created by PhpStorm.
 * User: weibo
 * Date: 2018/6/28
 * Time: 下午3:21
 */

namespace app\common\model;

use think\Model;

class Region extends Model{
    //获取热门城市 条件:status = 2
    public function getHotCities()
    {
        $con = [
            'status' => 2
        ];
        return $this->where($con)->order('pingyin asc')->select();
    }

    public function getAllProvinces()
    {
        $con = [
                'parent_id' => 0
        ];
        return $this->where($con)->order('pingyin asc')->select();
    }

    public function getSelectedCities($parent_id = null)
    {
        $con = [
            'parent_id' => $parent_id
        ];
        return $this->where($con)->order('pingyin asc')->select();
    }

    public function getDefaultCity()
    {
        $con = [
            'is_default' => 1
        ];
        return $this->where($con)->find();
    }

    public function getRegionNameByID($id)
    {
        return $this->where([
           'id' => $id
        ])->value('name');
    }
}