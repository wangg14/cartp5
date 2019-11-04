<?php
namespace app\index\controller;
use think\Db;
//导入Controller
use think\Controller;
class Register extends Controller
{
	//前台注册
    public function getregister()
    {//http://www.newcar.com/homeregister/register
    	//加载模板
    	return $this->fetch("Register/register");
    }

    //检测邮箱
    public function getcheckmail(){
    	$request=request();
    	$email=$request->get('email');
    	// echo $email;
    	//获取数据库的email
    	$arr=Db::table("users")->column("email");
    	// echo "<pre>";
    	// var_dump($arr);
    	//对比
    	if(in_array($email,$arr)){
    		echo 1;//邮箱已经存在
    	}else{
    		echo 0;//邮箱可用
    	}

    }

    //检测手机号是否重复
    public function getcheckphone(){
        $request=request();
        //获取参数
        $phone=$request->get("phone");
        // echo $phone;
        $arr=Db::table("users")->column("phone");
        if(in_array($phone,$arr)){
            echo 1;
        }else{
            echo 0;
        }
    }

    //获取短信校验码
    public function getcheckcode(){
        $request=request();
        $p=$request->get("p");
        // echo $p;
        //调用接口发送短信校验码
        funcs($p);
    }

    //检测校验码是否合法
    public function getcheckfcode(){
        $request=request();
        //输入的校验码
        $code=$request->get('code');
        // echo $code;
        if(isset($_COOKIE['fcode']) && !empty($code)){
            //获取手机接收到的校验码
            $fcode=$_COOKIE['fcode'];
            //对比
            if($code==$fcode){
                echo 1;//校验码正确
            }else{
                echo 2;//校验码有误
            }
        }elseif(empty($code)){
            echo 3;//输入的校验码不能为空
        }else{
            echo 4;//校验码过期
        }
    }

    //测试邮件发送
    public function getsends(){
        $s=sendss("987985143@qq.com",'o2o25项目测试',"<a href=''>激活用户</a>");
        echo "<pre>";
        var_dump($s);
    }
    //执行注册
    public function postdoregister(){
    	// echo "这是执行注册页面";
        $request=request();
        //封装注册数据
        $data=$request->only(['email','password','phone']);
        $data['username']="junge";
        //状态status 0 未激活 2 已经激活
        $data['status']=0;
        $data['token']=rand(1,10000);//安全秘钥 保护数据安全
        //插入数据的同时 获取id
        $id=Db::name("users")->insertGetId($data);
        if($id){
            // echo "注册成功";
            //发送邮件激活用户
            $res=sendss($data['email'],"用户激活","<a href='http://www.o2o25tp5.com/homeregister/jihuo?id={$id}&token={$data["token"]}'>激活用户</a>");
            if($res){
                $this->success("激活用户邮件已经发送,请登录qq邮箱激活用户","https://mail.qq.com");
            }else{
                $this->error("激活用户邮件发送失败");
            }
        }else{
            echo "注册失败";
        }
    }

    //激活
    public function getjihuo(){
        //获取id
        $id=$_GET['id'];
        //获取token
        $token=$_GET['token'];
        //获取数据
        $info=Db::table("users")->where("id","{$id}")->find();
        //对比token参数是否和数据表token参数相同
        if($token==$info['token']){
            //把状态值由0-》2(激活的用户) 修改数据
            //封装要修改数据
            $data['status']=2;
            //重新给token赋值
            $data['token']=rand(1,100000);
            //执行修改
            if(Db::table("users")->where("id","{$id}")->update($data)){
                echo "用户已经激活,请去登录";
            }
        }
        // echo $_GET['id'];
        // echo "这是用户激活操作";
        
    }
}


