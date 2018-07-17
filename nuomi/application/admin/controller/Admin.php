<?php
/**
 * Created by PhpStorm.
 * User: weibo
 * Date: 2018/7/4
 * Time: 上午11:34
 */
namespace app\admin\controller;

use app\common\controller\Base;
use think\App;

class Admin extends Base{
    public function __construct(App $app = null)
    {
        parent::__construct($app);
        $this->model_obj = model('Admin');
    }

    public function index()
    {
        $data = $this->model_obj->getAllAdmin();
        return view('', [
            'data' => $data
        ]);
    }
}