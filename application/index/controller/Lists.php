<?php
namespace app\index\controller;
use think\Db;
//导入Controller
use think\Controller;
class Lists extends Controller
{
	//前台列表
    public function getindex()
    {
    	//加载模板
    	return $this->fetch("Lists/index");
    }
}

