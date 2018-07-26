<?php

namespace app\index\controller;

use think\App;

class Index extends HeadController
{
    public function __construct(App $app = null)
    {
        parent::__construct($app);
        $this->getHeadMsg();
    }

    public function index()
    {
        return view('');
    }
}

