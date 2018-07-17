<?php
/**
 * Created by PhpStorm.
 * User: weibo
 * Date: 2018/7/12
 * Time: 上午10:28
 */

namespace app\common\validate;


use think\Validate;

class Store extends Validate
{
    protected $rule = [
        'name' => 'require',
        'phone' => 'require|min:8',
        'category_id' => 'require',
        'avg_price' => 'require',
    ];

    protected $message = [
        'name.require' => '店铺名称不能为空',
        'phone.require' => '电话不能为空',
        'phone.min' => '电话不能小于八位数',
        'category_id.require' => '分类不能为空',
        'avg_price.require' => '人均价格不能为空',
    ];

    protected $scene = [
        'add'      => ['name','phone','category_id','avg_price','address','recommend'],
        'edit'     => ['name','phone','avg_price','recommend']
    ];
}