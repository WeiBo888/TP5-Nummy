<?php
/**
 * Created by PhpStorm.
 * User: weibo
 * Date: 2018/7/6
 * Time: 下午12:13
 */
namespace app\common\validate;

use think\Validate;

class Business extends Validate{

    protected $rule = [
        'username' => 'require|length:6,30',
        'password' => 'require|length:6,16',
        'person_id' => 'require',
        'gender' => 'require',
        'bank_card' => 'require',
        'email' => 'email',
        'phone' => 'mobile',
        'province' => 'require',
    ];
    protected $message = [
        'username.require' => '用户名不能为空',
        'username.length' => '用户名必须在6,30位之间',
        'password.require' => '密码不能为空',
        'password.length' => '密码在6,16位之间',
        'person_id.require' => '身份证不能为空',
        'email' => '邮箱格式不正确',
        'phone' => '手机号格式不正确',
        'address' => '地址不能为空',
    ];

    protected $scene = [
        'add' => ['username', 'password', 'person_id', 'gender', 'bank_card', 'email', 'phone', 'province']
    ];
}