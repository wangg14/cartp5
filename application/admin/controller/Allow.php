<?php
namespace app\admin\controller;
//导入系统Config
use think\Config;
//导入Session
use think\Session;
//导入Controller
use think\Controller;
class Allow extends Controller
{
   public function _initialize(){
   	// echo "this is initialize";exit;
   	//检测的session
   	if(!Session::get("islogin")){
   		//跳转到登录界面
   		$this->error("请先登录","/adminlogin/login");
   	}
   	$request=request();
    //4.检测访问的模块操作是否在权限列表里 不在 无法访问到当前模块 在有权限
    //获取当前访问模块的控制器和方法
   	//获取控制器
   	$controller=strtolower($request->controller());
   	//获取方法
   	$action=$request->action();
   	//获取权限列表信息
   	$nodelist=Session::get('nodelist');
   	// echo $controller.":".$action;
   	if(empty($nodelist[$controller]) || !in_array($action,$nodelist[$controller])){
   		$this->error("抱歉,您没有权限访问该模块,请联系超级管理员","/admin/index");
   		exit;
   	}

   }

}
