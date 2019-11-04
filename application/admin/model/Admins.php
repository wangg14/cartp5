<?php
namespace app\admin\model;
//导入系统模型类Model
use think\Model;
//后台管理员模块 模型类
class Admins extends Model{
	//指定下模块对应的数据表
	protected $table="admin_users";
	//获取器 在获取字段值后对数据自动进行处理  例如:对状态字段做处理
	// status 待处理字段
	public function getStatusAttr($value){
		$status=[0=>"开启",1=>"禁用",2=>"待审核"];
		return $status[$value];
	}
} 
 ?>