<?php
namespace app\admin\controller;
//导入系统Config
use think\Config;
//导入Db
use think\Db;
use think\Controller;
class Users extends Controller
{   
    //后台用户模块列表
    public function getindex()
    {
        //创建请求对象
        $request=request();
        //获取搜索参数
        $k=$request->param("keywords");
        // echo $k;die;
    	// echo "这是列表数据";
        //获取列表数据
        $user=Db::table("users")->select();
        return $this->fetch("Users/index",['user'=>$user,'request'=>$request->param(),'k'=>$k]);

    }

    public function getadd(){
        // echo "this is add";
        return $this->fetch("Users/add");
    }

    //执行添加方法
    public function postinsert(){
        //请求对象
        $request=request();
        //获取需要添加的数据
        $data=$request->only(["username","password","email","phone"]);
        //密码加密
        $data['password']=md5($data['password']);
        $data['status']=0;
        $data['token']=rand(1,10000);
        // $data=$request->param();
        // echo "<pre>";
        // var_dump($data);
        //校验  User 验证器类
        $result=$this->validate($request->param(),"User");
        //对比 规则没有通过
        if(true!==$result){
            $this->error($result,"/adminuser/add");
        }
        //数据插入
        if(Db::table("users")->insert($data)){
            $this->success("数据添加成功","/adminuser/index");
        }else{
            $this->error("数据添加失败","/adminuser/add");
        }

    }

    //执行删除
    public function getdelete(){
        //获取id
        $request=request();
        $id=$request->param("id");
        // echo $id;
        //执行删除
        if(Db::table("users")->where("id","{$id}")->delete()){
           echo 1;
        }
    }

    //获取需要修改数据
    public function getedit(){
        $request=request();
        $id=$request->param("id");
        $info=Db::table("users")->where("id","{$id}")->find();
        //加载修改模板
        return $this->fetch("Users/edit",['info'=>$info]);
    }

    //执行修改
    public function postupdate(){
        $request=request();
        //获取id
        $id=$request->param("id");
        //获取修改数据
        $data=$request->only(['username','email','phone']);
        //执行修改
        if(Db::table("users")->where("id","{$id}")->update($data)){
            $this->success("数据修改成功","/adminuser/index");
        }else{
            $this->error("数据修改失败");
        }
    }

    //批量删除
    public function getdels(){
        //所有选中数据id
       $arr=isset($_GET['arr'])?$_GET['arr']:'';
       if($arr==""){
        echo "请至少选中一条数据";
        exit;
       }
        // echo json_encode($arr);
       //遍历
       foreach($arr as $v){
        if(Db::table("users")->where("id","{$v}")->delete()){

        }
       }
       echo 1;
        // echo "ymd";
    }

    
}
