<?php
namespace app\common\validate;

use think\Validate;

class User extends Validate
{
    protected $rule = [
        'username' => 'require|max:30',
        'password' => 'require|min:6',
        'phoneNumber' => 'mobile',
        'email' => 'email',
    ];

    protected $message = [
        'username.require' => '用户名不能为空',
        'username.max'     => '用户名不能超过30位',
        'password.require' => '密码不能为空',
        'password.min'     => '密码不能小于6位',
        'phoneNumber'      => '手机号码错误',
        'email'            => '邮箱格式错误',
    ];

    protected $scene = [
        'add'      => ['username','password','phoneNumber','email'],
        'login'     => ['username','password']
    ];
}

