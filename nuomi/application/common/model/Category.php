<?php
/**
 * Created by PhpStorm.
 * User: weibo
 * Date: 2018/6/29
 * Time: 下午5:35
 */
namespace app\common\model;

use think\Model;

class Category extends Model{
    //获取所有菜单信息(前端)
    public function getAllCategories()
    {
        $con = [
            'status' => 1
        ];
        return $this->where($con)->select();
    }

//后端

    //获取所有一/二/三级分类(根据上一级级id)
    public function getChildLevelByParentID($parent_id = 0)
    {
        $con = [
            'parent_id' => $parent_id,
        ];
        return $this->where($con)->paginate(3);
    }

    public function getCategoryByID($id)
    {
        $con = [
            'id' => $id
        ];
//        dump($id);
        return $this->where($con)->value('name');
    }

    //获取所有一/二/三级分类(根据上一级级id)
    public function getCategoryByParentID($parent_id = 0)
    {
        $con = [
            'parent_id' => $parent_id,
        ];
        return $this->where($con)->select();
    }

    //通过一级分类查出三级分类
    public function getCategoryByRootParentID($root_parent_id)
    {
        return $this->where("root_parent_id = $root_parent_id and root_parent_id != parent_id")->select();
    }
}