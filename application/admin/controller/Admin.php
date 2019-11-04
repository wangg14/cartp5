<?php
namespace app\admin\controller;
//导入系统Config
use think\Config;
//导入Controller
use think\Controller;
/**
 * 后台页面
 */
class Admin extends Allow
{
    public function getindex()
    {
    	//加载后台模板
    	return $this->fetch("Admin/index");
    }

}
