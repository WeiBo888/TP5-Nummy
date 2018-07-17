<?php
/**
 * Created by PhpStorm.
 * User: weibo
 * Date: 2018/7/16
 * Time: 下午5:09
 */

namespace app\common\validate;


use think\Validate;

class Goods extends Validate
{
    protected $rule = [
        'name' => 'require|max:30',
        'store_id' => 'require',
        'old_price' => 'require',
        'new_price' => 'require',
        'start_time' => 'require',
        'end_time' => 'require',
        'image_url' => 'require',
        'good_desc' => 'require',
        'notice' => 'require',
    ];

    protected $message = [
        'name.require' => '商品名不能为空',
        'name.max' => '商品名不能大于30位',
        'store_id.require' => '店铺名不能为空',
        'old_price.require' => '原价不能为空',
        'new_price.require' => '现价不能为空',
        'start_time.require' => '开始时间不能为空',
        'end_time.require' => '结束时间不能为空',
        'image_url.require' => '商品图片不能为空',
        'good_desc.require' => '商品描述不能为空',
        'notice.require' => '使用须知不能为空'
    ];

    protected $scene = [
        'add' => ['name','store_id','old_price','new_price','start_time','end_time','image_url','good_desc','notice']
    ];
}