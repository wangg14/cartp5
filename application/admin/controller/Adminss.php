<?php
namespace app\admin\controller;
//导入系统Config
use think\Config;
//导入Db
use think\Db;
//导入Controller
use think\Controller;
//导入当前模块对应的模型类
use app\admin\model\Admins;
class Adminss extends Allow
{
	//获取列表数据
    public function getindex()
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
             //创建请求对象
            $request=request();
            //获取搜索参数
            $k=$request->param("keywords");
    		//获取所有数据
    		$user=Admins::paginate(2);
    		return $this->fetch("Adminss/index",['user'=>$user,'request'=>$request->param(),'k'=>$k]);
    }

    //加载添加模板
    public function getadd(){
    	return $this->fetch("Adminss/add");
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

    //分配角色
    public function getrolelist(){
        //获取管理员id
        $request=request();
        $id=$request->param("id");
        //获取用户信息
        $info=Db::table("admin_users")->where("id","{$id}")->find();
        //获取所有的角色信息
        $role=Db::table("role")->select();
        //获取当前用户所具有的角色信息 角色id
        $data=Db::table("user_role")->where("uid","{$id}")->select();
        // echo "<pre>";
        // var_dump($data);
        //遍历数据
        foreach($data as $v){
            $rids[]=$v['rid'];
        }
        // echo "<pre>";
        // var_dump($rids);
        // echo $id;
        return $this->fetch("Adminss/rolelist",['info'=>$info,'role'=>$role,'rids'=>$rids]);
    }

    //保存角色
    public function postsaverole(){
        //操作的是用户角色表
        //获取用户新角色信息
        $role=$_POST['rid'];
        // echo "<pre>";
        // var_dump($role);
        //获取用户id
        $request=request();
        $uid=$request->param("uid");
        //删除当前用户已有的角色信息
        Db::table("user_role")->where("uid","{$uid}")->delete();
        // echo $uid;
        //遍历
        foreach($role as $key=>$value){
            //封装需要添加的数据
            $data['uid']=$uid;//用户id
            $data['rid']=$value;//新角色id
            //执行数据插入user_role
            Db::table("user_role")->insert($data);
        }

        $this->success("角色分配成功","/adminusers/index");

    }

}
