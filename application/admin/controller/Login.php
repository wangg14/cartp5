<?php
namespace app\admin\controller;
//导入系统Config
use think\Config;
//导入Db
use think\Db;
//导入Session类
use think\Session;
//导入Controller
use think\Controller;
class Login extends Controller
{
    public function getlogin()
    {
    	//加载后台登录模板
    	return $this->fetch("Login/login");
    }

    //执行登录
    public function postdologin(){
    	//创建请求对象
    	$request=request();
    	// echo "this is dologin";
    	//获取输入校验码
    	$fcode=$request->param("fcode");
    	// echo $fcode;
    	// 校验验证码
    	if(captcha_check($fcode)){
    		// echo "ok";
    		//获取登录的用户名和密码
    		$name=$request->param("name");
    		$password=$request->param("password");
    		// echo $name.":".$password;
    		//检测用户名
    		$row=Db::table("admin_users")->where("name",$name)->select();
    		if($row){
    			//检测密码
    			if($row[0]['password']==$password){
    				//设置用户登录的session信息
    				Session::set("name",$name);
    				Session::set("islogin",$row[0]['id']);
                    //1.获取当前登录用户所具有的全部权限信息
                    $list=Db::query("select n.name,n.mname,n.aname from user_role as ur,role_node as rn,node as n where ur.rid=rn.rid and rn.nid=n.id and uid={$row[0]['id']}");
                    // echo "<pre>";
                    // var_dump($list);exit;
                    //2.初始化权限信息 添加后台首页的权限信息 admin 控制器 index 控制器下的方法
                    $nodelist['admin'][]="getindex";
                    //遍历
                    foreach($list as $v){
                        //写入权限信息
                        $nodelist[$v['mname']][]=$v['aname'];
                        //判断
                        //如果具有add 添加insert
                        if($v['aname']=="getadd"){
                            $nodelist[$v['mname']][]="postinsert";
                        }
                        //如果具有edit 添加update
                        if($v['aname']=="getedit"){
                            $nodelist[$v['mname']][]="postupdate";
                        }
                    }
                    // echo "<pre>";
                    // var_dump($nodelist);exit;
                    //3.把获取到的当前用户所具有的全部权限信息存储在Session里
                    Session::set("nodelist",$nodelist);
                    
    				//跳转到后台首页
    				$this->success("登录成功","/admin/index");
    			}else{
    				$this->error("密码有误","/adminlogin/login");
    			}
    			
    		}else{
    			$this->error("用户名有误","/adminlogin/login");
    		}
    		
    	}else{
    		// echo "error";
    		//跳转到登录界面
    		$this->error("验证码有误,请重新输入","/adminlogin/login");
    	}
    }

    //执行退出
    public function getlogout(){
    	//销毁session
    	Session::delete("name");
    	Session::delete("islogin");
    	$this->success("退出成功","/adminlogin/login");
    }

}
