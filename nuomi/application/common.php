<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

function status($status){
    if ($status == 1){
        return "<span class=\"label label-success radius\">已启用</span>";
    }else if ($status == 0){
        return "<span class=\"label label-default radius\">已删除</span>";
    }else if ($status == -1){
        return "<span class=\"label label-danger radius\">已禁用</span>";
    }
}

//根据性别字符获取性别汉字
function getGender($sex){
    if ($sex == 'M'){
       return '男';
    }else{
        return '女';
    }
}

//根据address的id查询城市名称
function getAddress($idString){
    //将字符串根据逗号拆分成数组
    $arr = explode(',',$idString);
    $str = '';
    for ($i=0;$i<count($arr);$i++){
        $str .= model('Region')->getRegionNameByID($arr[$i]);
    }
    return $str.'市';
}

//curl网络请求方法
function doCurl($url,$type = 0, $data = []){
    //初始curl会话
    $ch = curl_init();
//    设置参数
    curl_setopt($ch, CURLOPT_URL, $url);//设置要请求的url
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);//请求的结果以文本刘形式返回
    curl_setopt($ch,CURLOPT_HEADER,0);//是否返回头部信息
    if ($type == 1){
        //post请求
        curl_setopt($ch,CURLOPT_POST,$url);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);//设置请求体
    }
//    执行请求
    $res = curl_exec($ch);
    //关闭请求
    curl_close($ch);

    return $res;
}

//通过分类id找分类名称
function getCategoryNameByID($category_id){
    $category_id = explode(',',$category_id);
    $category = model('Category');
    $res = [];
    for ($i=0;$i<count($category_id);$i++) {
        $res[] = $category->getCategoryByID($category_id[$i]);
    }
    return implode(',',$res);
}

//获取分页样式
function pagination($data){
    if (!$data || count($data) < 3){
        return '';
    }else{
        $result = "<div class='cl pd-5 bg-1 bk-gray mt-20 tp5-nuomi'>".$data->render()."</div>";
        return $result;
    }
}

//根据商家id找商户名
function getStoreNameByID($id){
    $store = model('Store');
    return $store->where(['id' => $id])->value('name');

}

//根据商家id找商户名
function getBisNameByID($id){
    $bis = model('Business');
    return $bis->where(['id' => $id])->value('username');

}