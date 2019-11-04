<?php
namespace app\index\widget;
//导入Controller
use think\Controller;
//导入Db
use think\Db;
//定义扩展类
class Cate extends Controller{
	public function getcatesbypid($pid){
		$data=Db::table("cates")->where("pid","{$pid}")->select();
		$data1=[];
		//遍历数组$data
		foreach($data as $key=>$value){
			$value['shop']=$this->getcatesbypid($value['id']);
			$data1[]=$value;
		}
		return $data1;
	}
	//加载页面头部方法
	public function header(){
		$cate=$this->getcatesbypid(0);
		//加载模板 分配数据
		return $this->fetch("Cate:header",['cate'=>$cate]);
	}
	//加载页面尾部方法
	public function footer(){
		//加载尾部模板
		return $this->fetch("Cate:footer");
	}
} 
 ?>