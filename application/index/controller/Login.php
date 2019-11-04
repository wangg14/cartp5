<?php
namespace app\index\controller;
use think\Db;
//导入Controller
use think\Controller;
class Login extends Controller
{
	//前台登录
    public function getlogin()
    {
    	//加载模板
    	return $this->fetch("Login/login");
    }

    //执行登录
    public function postdologin(){
        $request=request();
        //获取参数
        $email=$request->param("email");
        $password=$request->param("password");
        //获取数据
        $res=Db::table("users")->where("email","{$email}")->find();
        if($res){
            //检测密码
            if($password==$res['password']){
                //检测状态
                if($res['status']==2){
                    echo "登录成功";
                }else{
                    // echo "无效用户";
                    $this->error("无效用户,请去注册","/homeregister/register");
                }

            }else{
                $this->error("密码有误,请重新输入","/homelogin/login");

            }
        }else{
            $this->error("邮箱名有误,请重新输入","/homelogin/login");
        }
    }

    //忘记密码
    public function getforget(){
        //加载模板
        return $this->fetch("Login/forget");
    }

    public function postdoforget(){
        $request=request();
        //获取邮箱
        $email=$request->param("email");
        //获取数据表数据
        $info=Db::table("users")->where("email","{$email}")->find();
        //调用发送邮件方法
        $res=sendss($email,"密码找回","<a href='http://www.o2o25tp5.com/homelogin/reset?id={$info["id"]}&token={$info["token"]}'>密码重置</a>");
        if($res){
            $this->success("重置密码邮件已经发送,请登录qq邮箱重置密码","https://mail.qq.com");
        }
    }

    public function getreset(){
        // echo "这是密码重置";
        //获取参数
        $id=$_GET['id'];
        $token=$_GET['token'];
        //获取数据表数据
        $info=Db::table("users")->where("id","{$id}")->find();
        // echo $id.":".$token;
        //对比下token参数是否和数据表的token参数相同
        if($token==$info['token']){
            //加载重置密码模板
            return $this->fetch("Login/reset",['id'=>$id]);
        }
        
    }

    //执行密码重置
    public function postdoreset(){
        $request=request();
        //获取id
        $id=$request->param('id');
        //封装修改的数据
        $data['password']=$request->param("password");
        $data['token']=rand(1,10000);//重新赋值token
        //密码修改
        if(Db::table("users")->where("id","{$id}")->update($data)){
            $this->success("重置密码成功,请去登录","/homelogin/login");
        }
    }
}


