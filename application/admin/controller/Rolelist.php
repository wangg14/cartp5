<?php
namespace app\admin\controller;
//导入系统Config
use think\Config;
//导入Db类
use think\Db;
//导入Controller
use think\Controller;
class Rolelist extends Allow
{
	//列表
    public function getindex()
    {
    	$role=Db::table("role")->select();
    	return $this->fetch("Rolelist/index",['role'=>$role]);
    }

    //添加
    public function getadd(){
    	echo "这是角色添加";
    }

    //分配权限
    public function getauth(){
    	//获取角色id
    	$request=request();
    	$id=$request->param("id");
    	//获取角色信息
    	$role=Db::table("role")->where("id","{$id}")->find();
    	//获取全部权限
    	$node=Db::table("node")->select();
    	//加载模板
    	return $this->fetch("Rolelist/auth",['role'=>$role,'node'=>$node]);
    }

}
