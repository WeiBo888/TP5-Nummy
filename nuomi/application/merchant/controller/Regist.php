<?php
/**
 * Created by PhpStorm.
 * User: weibo
 * Date: 2018/7/5
 * Time: 上午11:26
 */

namespace app\merchant\controller;

use think\Controller;
use think\exception\PDOException;

class Regist extends Controller
{

    public function index()
    {
        $region = model('Region');
        $provinces = $region->getAllProvinces();
        return view('', [
            'provinces' => $provinces
        ]);
    }

    public function citySelect()
    {
        $data = input();
        $city = model('Region');
        $cities = $city->getSelectedCities($data['id']);
        return json($cities);
    }

    public function save()
    {

        try {
            $data = input('post.');
            $validate = validate('Business');
            $res = $validate->scene('add')->check($data);
            if (!$res) {
                $this->error($validate->getError());
            } else {
                $data['password'] = md5($data['password']);
                $bis = model('Business');

                $bis['address'] = ($data['city'] != '请选择城市') ? $data['province'] . ',' . $data['city'] : $data['province'];
                $res = $bis->save($data);
                if ($res) {
                    $this->success('添加成功', 'login/index');
                } else {
                    $this->error('添加失败');
                }
            }
        } catch (PDOException $e) {
            //删除图片
            if (file_exists('.' . $data['person_img'])) {
                unlink('.' . $data['person_img']);
            }
            $this->error('注册失败');
        }

    }

}