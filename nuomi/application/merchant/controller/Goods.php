<?php
/**
 * Created by PhpStorm.
 * User: weibo
 * Date: 2018/7/16
 * Time: 下午3:11
 */

namespace app\merchant\controller;


use app\common\controller\Base;
use think\App;

class Goods extends Base
{
    public function __construct(App $app = null)
    {
        parent::__construct($app);
        $this->model_obj = model('Goods');
    }

    public function index()
    {
        //获取当前session下的所有商品
        $data = $this->model_obj->where(['bis_id' => $this->userInfo['id']])->select();
        return view('',[
            'data' => $data
        ]);
    }

    public function add()
    {
        if (!$_POST){
//            进入添加页面
            $this->assign('userInfo', session('userInfo'));
            $store = model('Store')->getAllStores($this->userInfo['id']);
            return view('',[
                'store' => $store
            ]);
        }else{
//            保存数据
            $data = input();
//            校验数据
            $validate = validate('Goods');
            $res = $validate->scene('add')->check($data);
            if (!$res){
                $this->error($validate->getError());
            }else{
                $data['bis_id'] = $this->userInfo['id'];
                $res = $this->model_obj->save($data);
                if ($res){
                    $this->success('添加成功');
                }else{
                    $this->error('添加失败');
                }
            }
        }

    }

    public function edit()
    {
        if ($_POST){
            //            保存数据
            $data = input();
//            校验数据
            $validate = validate('Goods');
            $res = $validate->scene('add')->check($data);
            if (!$res){
                $this->error($validate->getError());
            }else{
                $res = $this->model_obj->save($data, ['id'=>$data['id']]);
                if ($res){
                    $this->success('更新成功');
                }else{
                    $this->error('更新失败');
                }
            }
        }else {
            $id = input();
            $data = $this->model_obj->where(['id' => $id])->find();
            return view('', [
                'goods' => $data
            ]);
        }
    }
}