<?php
namespace app\index\controller;
use think\Db;
//导入Controller
use think\Controller;
class Index1 extends Controller
{
	//前台首页
    public function getindex()
    {
    	
    	//加载模板
    	return $this->fetch("Index1/index");
    }
}
