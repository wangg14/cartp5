<?php
namespace app\admin\controller;
//导入系统Config
use think\Config;
//导入Controller
use think\Controller;
/**
 * 上传文件管理
 */
class File extends Controller
{
    public function getindex()
    {
    	//加载模板
    	return $this->fetch("File/index");
    }

    //执行上传
    public function postdofile(){
    	$request=request();
    	//1. 普通上传
    	// // (1)获取表单上传数据
    	//  $info=$request->file("file");
    	// // (2)移动
    	//  if($info){
    	//  	//移动到指定的目录下 ROOT_PATH 根目录  DS 目录分隔符
    	//  	$file=$info->move(ROOT_PATH."public".DS."uploads");
    	//  	// echo "<pre>";
    	//  	// var_dump($file);
    	//  	echo "上传文件信息".$file->getSavename()."<br>";
    	//  	echo "上传文件后缀".$file->getExtension();
    	//  }

    	//2.带有检验上传
    	// (1)获取上传数据
    	$file=$request->file("file");
    	//(2)加规则
    	$result=$this->validate(['file1'=>$file],["file1"=>"require|image"],["file1.require"=>"上传文件不能为空","file1.image"=>"非法图像文件"]);
    	//判断
    	if(true!==$result){
    		$this->error($result,"/file/index");
    	}

    	//(3)移动
    	$info=$file->move(ROOT_PATH."public".DS."uploads");
    	// echo "上传文件信息".$info->getSavename()."<br>";
    	$savename=$info->getSavename();//20180607\f939de107eae9b2ec11db8175670f4a1.jpg
    	// echo "上传文件后缀".$info->getExtension();
    	$ext=$info->getExtension();

    	//图像处理
    	//打开需要处理的图像使用Composer安装ThinkPHP5的图像处理类库：
        //composer require topthink/think-image
    	$img=\think\Image::open("./uploads/".$savename);// ./uploads/20180607\f939de107eae9b2ec11db8175670f4a1.jpg
    	//名图片字
    	$name=time()+rand(1,1000);
    	//裁剪
    	// $img->crop(100,100,20,100)->save("./uploads/imgpublic/".$name.".".$ext);
    	//图像缩放
    	// $img->thumb(100,100)->save("./uploads/imgpublic/".$name.".".$ext);
        //图片水印 文字水印
        // $img->water("./logo.jpg",\think\Image::WATER_NORTHWEST,30)->save("./uploads/imgpublic/".$name.".".$ext);
        //文字水印
        $img->text("thinkPHP","./msyh.ttf",20,"#ffffff")->save("./uploads/imgpublic/".$name.".".$ext);
    }

}
