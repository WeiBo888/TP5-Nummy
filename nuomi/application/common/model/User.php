<?php

namespace app\common\model;

use think\Model;

class User extends Model
{
    public $autoWriteTimestamp = false;
    //添加新用户的方法
    public function add($data = [])
    {
        $data['create_time'] = time();
        $data['update_time'] = time();
        $this->save($data);
        return $this->id; //主键id
    }

    //判断用户名是否存在
    public function checkUserName($username = '')
    {
        $con = [
            'status' => 1,
            'username' => $username
        ];
        $res = $this->where($con)->find();
        return $res;
    }
    
    //获取所有用户信息
    public function getAllUsers()
    {
        $count = User::count();
        $content = $this->select();
        $data = [
            'count' => $count,
            'content' => $content
        ];
        return $data;
    }
}