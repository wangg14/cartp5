<?php
namespace app\index\controller;
use think\Db;
//导入Controller
use think\Controller;
class Index extends Controller
{
	//前台首页
    public function getindex()
    {
    	
    	// echo "<pre>";
    	// print_r($cate);
    	//加载模板
    	return $this->fetch("Index/index");
    }
}

// 顶级分类
// [
// 	'id'=>116
// 	'name'=>手机
// 	'pid'=>0,
// 	'path'=>0,
// 	'shop'=>[
// 				一级分类信息
// 				[
// 					'id'=>117,
// 					'name'=>"oppo",
// 					'pid'=>116,
// 					'path'=>0,116
// 					'shop'=>[
// 								二级分类
// 								[
// 									'name'=>'oppox1',
// 									'pid'=>117,
// 									'path'=>0,116,117,
// 									'shop'=>[
// 												三级分类....
// 											]

// 								]
// 							]
// 				]
// 			]
// ]
