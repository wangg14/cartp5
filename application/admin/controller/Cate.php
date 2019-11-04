<?php
namespace app\admin\controller;
//导入系统Config
use think\Config;
//导入Db
use think\Db;
use think\Controller;
class Cate extends Allow
{   
    //调整类别顺序
    public function getcates(){
        $cate=Db::query("select *,concat(path,',',id) as paths from cates order by paths");
        //遍历数据
        foreach($cate as $key=>$value){
            // echo $value['path']."<br>";
            //字符串转换为数组
            $arr=explode(",",$value['path']);
            // echo "<pre>";
            // var_dump($arr);
            //获取逗号个数
            $len=count($arr)-1;
            // echo $len."<br>";
            //重复字符串函数
            $cate[$key]['name']=str_repeat("--|",$len).$value['name'];
        }
        return $cate;
    }
    //后台分类模块列表
    public function getindex()
    {
        //获取分类信息
        $cate=$this->getcates();
    	// echo "这是列表数据";
        return $this->fetch("Cate/index",['cate'=>$cate]);

    }

    public function getadd(){
        //获取全部的分类信息
        $cate=$this->getcates();
        // echo "this is add";
        return $this->fetch("Cate/add",['cate'=>$cate]);
    }

    //执行添加
    public function postinsert(){
        $request=request();
        //获取name pid
        $data=$request->only(['name','pid']);
        // echo "<pre>";
        // var_dump($data);
        //获取pid
        $pid=$request->param('pid');
        //判断
        if($pid==0){
            //添加顶级分类
            //拼接path
            $data['path']="0";
            // echo "<pre>";
            // var_dump($data);
        }else{
            //添加不是顶级分类
            //拼接path 父类path和id组合字符串
            //获取父类信息
            $info=Db::table("cates")->where("id","{$pid}")->find();
            //拼接当前分类的path
            $data['path']=$info['path'].",".$info['id'];
            // echo "<pre>";
            // var_dump($data);
        }

        //执行数据插入
        if(Db::table("cates")->insert($data)){
            // echo "ok";
            $this->success("分类添加成功","/admincates/index");
        }else{
            $this->error("分类添加失败","/admincates/add");
        }
    }

    //执行删除
    public function getdelete(){
        $request=request();
        //获取id
        $id=$request->param("id");
        //当前删除类别下有子类信息 不能删除 提示信息 请先删除子类
        //获取当前类别下子类信息(直系子类)个数
        $s=Db::table("cates")->where("pid","{$id}")->Count();
        // echo $s;
        if($s>0){
            $this->error("请先干掉孩子","/admincates/index");
        }
        //当前类别下没有子类信息  直接删除
        if(Db::table("cates")->where("id","{$id}")->delete()){
            $this->success("分类删除成功","/admincates/index");
        }else{
            $this->error("分类删除失败","/admincates/index");
        }

    }

    public function getedit(){
        $request=request();
        //获取id
        $id=$request->param("id");
        //获取所有的分类信息
        $cate=$this->getcates();
        //获取需要修改的数据
        $info=Db::table("cates")->where("id","{$id}")->find();
        //加载模板 分配数据
        return $this->fetch("Cate/edit",['info'=>$info,'cate'=>$cate]);
    }

    //执行修改
    public function postupdate(){
        $request=request();
        //获取id
        $id=$request->param("id");
        //封装需要修改的数据
        $data=$request->only(['name']);
        //执行修改
        if(Db::table("cates")->where("id","{$id}")->update($data)){
            $this->success("修改成功","/admincates/index");
        }else{
            $this->success("修改失败");
        }
    }

    
}
