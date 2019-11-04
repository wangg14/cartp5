<?php
namespace app\admin\controller;
//导入系统Config
use think\Config;
//导入Db
use think\Db;
//导入Controller
use think\Controller;
class Articles extends Controller
{
	//列表
    public function getindex()
    {
    	$request=request();
    	//获取数据总条数
    	$tot=Db::table("articles")->Count();
    	// echo $tot;
    	//每页显示的数据条数为2条
    	$rev=2;
    	//获取最大页
    	$m=ceil($tot/$rev);
    	$pp=array();
    	// echo $m;
    	//循环处理
    	for($i=1;$i<=$m;$i++){
    		$pp[$i]=$i;
    	}
    	// echo "<pre>";
    	// var_dump($pp);
    	//获取附加参数page
    	$page=$request->get("page");
    	if(empty($page)){
    		$page=1;
    	}
    	//获取偏移量
    	$offset=($page-1)*$rev;
    	//准备sql语句
    	$sql="select * from articles limit {$offset},{$rev}";
    	//判断 是否为Ajax请求
    	if($request->isAjax()){
    		//获取Ajax分页数据
    		$article=Db::query($sql);
    		// echo $page;
    		// exit;
    		//执行sql
    		//加载独立模板(属于Ajax请求)
    		return $this->fetch("Articles/test",['article'=>$article]);
    	}

    	// echo "这是文章列表";
    	//获取数据
    	$article=Db::query($sql);
    	//加载模板分配数据
    	return $this->fetch("Articles/index",['article'=>$article,'pp'=>$pp]);
    }

    //添加
    public function getadd(){
    	// echo "这是文章添加";
        //加载添加模板
        return $this->fetch("Articles/add");
    }

       //执行添加
    public function postinsert(){
        // echo "这是公告添加";
        $request=request();
        //文件上传
        //1.；获取上传表单信息
        $file=$request->file("pic");

        //设置上传规则
        $result=$this->validate(['file1'=>$file],['file1'=>"require|image"],['file1.require'=>'上传文件不能为空','file1.image'=>'非法图像文件']);
        if(true !==$result){
            $this->error($result,"/adminarticles/add");
        }
        //2.移动
        $info=$file->move(ROOT_PATH."public".DS."uploads");
        //获取上传文件信息
        $savename=$info->getSaveName();
        //获取后缀
        $ext=$info->getExtension();
        //初始化文件名字
        $name=time()+rand(1,10000);
        // echo $savename.":".$ext;
        //缩放
        //打开需要处理的图像
        $img=\think\Image::open("./uploads/".$savename);
        //调用方法 thumb
        $img->thumb(100,100)->save("./uploads/imgpublic/".$name.".".$ext);
        //删除原图 tp5内置特性 没有权限
        // unlink("./uploads/".$savename);
        //获取需要插入的数据
        $data=$request->only(['title','descr']);
        //封装数据pic
        $data['pic']="/uploads/imgpublic/".$name.".".$ext;
        //封装原图路径
        $data['opic']="./uploads/".$savename;
        //执行插入
        if(Db::table("articles")->insert($data)){
            $this->success("数据添加成功","/adminarticles/index");
        }else{
            $this->error("数据添加失败");
        }
    }

    //执行删除
    public function getdelete(){
        //获取id
        $request=request();
        $id=$request->param('id');
        //获取需要删除的数据
        $info=Db::table("articles")->where("id","{$id}")->find();
        //获取descr
        $descr=$info['descr'];
        // echo $descr;exit;//  <p><img src="/ueditor/php/upload/image/20180619/1529395126.jpg" title="1529395126.jpg" alt="1529395126.jpg" style="width: 100px; height: 100px;" width="100" vspace="0" height="100" border="0"/></p>
        //获取src
        preg_match_all('/<img.*?src="(.*?)".*?>/is',$descr,$arr);
        // echo "<pre>";
        // var_dump($arr);exit;
        // echo "<pre>";
        // var_dump($info);exit;
        //获取pic
        $pic=".".$info['pic'];
        //获取opic
        $opic=$info['opic'];
        // echo $pic;
        //1.删除数据库的数据
        if(Db::table("articles")->where("id","{$id}")->delete()){
            //2.把原图和缩放的图删除掉
            //删除缩放图
            unlink($pic);
            //删除原图
            unlink($opic);
            //3.如果百度编辑器有上传图片 删除百度编辑器上传的图片
            if(isset($arr[1])){
                //遍历
                foreach($arr[1] as $key=>$value){
                    unlink(".".$value);
                }
            }
            $this->success("删除成功","/adminarticles/index");
        }else{
            $this->success("删除失败","/adminarticles/index");
        }
        
    }


}
