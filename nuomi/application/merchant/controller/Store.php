<?php
/**
 * Created by PhpStorm.
 * User: weibo
 * Date: 2018/7/10
 * Time: 下午4:29
 */

namespace app\merchant\controller;


use app\common\controller\Base;
use function PHPSTORM_META\type;
use think\App;
use think\exception\PDOException;

class Store extends Base
{
    public function __construct(App $app = null)
    {
        parent::__construct($app);
        $this->model_obj = model('Store');

    }

    //显示登录商户的所有商铺
    public function index(){
        $this->assign('userInfo', session('userInfo'));
        $data = $this->model_obj->getAllStores($this->userInfo['id']);
//        $cate_array = explode(',',$data[5]['category_id']);
//        dump($cate_array);exit();
//        $data[0]['name'] = model('Category')->getCategoryByID($data[0]['category_id']);
//        dump($data[0]['name']);
//        exit();
//        $data['category_name'] = $category_name;
        return view('',[
            'data' => $data
        ]);
    }

    public function regist()
    {
        $region = model('Region');
        $provinces = $region->getAllProvinces();
        $category = model('Category');
        $categories = $category->getChildLevelByParentID(0);
        return view('',[
            'provinces' => $provinces,
            'categories' => $categories
        ]);
    }

    public function citySelect()
    {
        $data = input('id');
//        dump($data);
        $city = model('Region');
        $cities = $city->getSelectedCities($data);
        return json($cities);
    }

    public function categorySelect()
    {
        $data = input('id');
        $category = model('Category');
        $categories = $category->getChildLevelByParentID($data);
        return json($categories);
    }

    public function save()
    {
        try {
            $data = input();
            $data['bis_id'] = $this->userInfo['id'];
            unset($data['file']);
            $validate = validate('Store');
            $res = $validate->scene('add')->check($data);

            if (!$res) {
                $this->error($validate->getError());
            } else {
                $data['address'] = $data['street'];
                $data['category_id'] = implode(',', $data['category_id']);
                $region = model('Region');
                $map = \Map::getLgnLat($region->getRegionNameByID($data['province']) . $region->getRegionNameByID($data['city']) . '市' . $data['street']);
                $data['longitude'] = $map['result']['location']['lng'];
                $data['latitude'] = $map['result']['location']['lat'];
                $res = $this->model_obj->save($data);
                if (!$res) {
                    $this->error('添加失败');
                } else {
                    $this->success('添加成功');
                }
            }
        }catch (PDOException $e){
            //删除图片
            if (file_exists('.' . $data['store_img'])) {
                unlink('.' . $data['store_img']);
            }
            if (file_exists('.' . $data['permits_img'])) {
                unlink('.' . $data['permits_img']);
            }
            $this->error('注册失败');
        }
    }

    //店铺修改
    public function edit()
    {
        if ($_POST) {
            $data = input();
            unset($data['file']);
            $validate = validate('Store');
            $res = $validate->scene('edit')->check($data);

            if (!$res){
                $this->error($validate->getError());
            }else{
                $res = $this->model_obj->save($data,['id'=>$data['id']]);
                if (!$res){
                    $this->error('更新失败');
                }else{
                    $this->success('更新成功');
                }
            }
        }else {
            $id = input();
            $store = $this->model_obj->where(['id' => $id])->find();
            return view('', [
                'store' => $store
            ]);
        }
    }
}