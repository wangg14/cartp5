<?php
namespace app\admin\controller;
//导入系统Config
use think\Config;
//导入Db类
use think\Db;
//导入Controller
use think\Controller;
class Lists extends Allow
{
	//列表
    public function getindex()
    {
    	$node=Db::table("node")->select();
    	return $this->fetch("Lists/index",['node'=>$node]);
    }

    //添加
    public function getadd(){
    	echo "这是角色添加";
    }

}
