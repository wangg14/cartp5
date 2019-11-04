<?php
namespace app\admin\controller;
//导入系统Config
use think\Config;
//导入Controller
use think\Controller;
//导入当前模块对应的模型类
use app\admin\model\Admins;
class Admins extends Allow
{
	//获取列表数据
    public function getindex()
    //
    {
    		//获取单条数据
    		// $data=Admins::get(1);
    		//条件
    		// $data=Admins::get(["name"=>"admins"]);
    		//获取单条数据2
    		//实例化模型类
    		// $admins=new Admins();
    		// $data=$admins->where("id",1)->find();
    		//获取多条数据
    		// $allparams=Admins::all('1,2,3');
    		//获取所有数据
    		$user=Admins::paginate(2);
    		return $this->fetch("Admins/index",['user'=>$user]);
    }

    //加载添加模板
    public function getadd(){
    	return $this->fetch("Admins/add");
    }

    //执行添加
    public function postinsert(){
    	$request=request();
    	//获取需要添加数据
    	$data=$request->only(['name','password']);
    	$data['status']=0;
    	//执行插入
    	if(Admins::create($data)){
    		$this->success("数据添加成功","/adminusers/index");
    	}else{
    		$this->error("数据插入失败");
    	}
    }

    //执行删除
    public function getdelete(){
    	$request=request();
    	//获取id
    	$id=$request->param("id");
    	//执行删除
    	if(Admins::where("id","{$id}")->delete()){
    		$this->success("数据删除成功","/adminusers/index");
    	}else{
    		$this->error("数据删除失败");
    	}
    }

}
