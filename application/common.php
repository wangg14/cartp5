<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

function fun(){
	// echo "this is common fun 函数";
	//加载三方类 Phone
	$ph=new \Org\Util\Phone();
	// echo "<pre>";
	// var_dump($ph);
	$ph->sends();
}
//导入核心配置类
use think\Config;
//导入发送邮件核心类
// $to 接受方 $title 邮件主题 $content 内容
function sendss($to,$title,$content){
	$mail=new \Org\Util\PHPMailer();
	//初始化参数
		//设置字符集
	$mail->CharSet="utf-8";
	//设置采用SMTP方式发送邮件
	$mail->IsSMTP();
	//设置邮件服务器地址
	$mail->Host=Config::get('mailarr.host');//获取配置文件信息 
	//设置邮件服务器的端口 默认的是25  如果需要谷歌邮箱的话 443 端口号
	$mail->Port=25;
	//设置发件人的邮箱地址
	$mail->From=Config::get('mailarr.username'); //
	// $mail->FromName='我';//
	//设置SMTP是否需要密码验证
	$mail->SMTPAuth=true;
	//发送方
	$mail->Username=Config::get('mailarr.username');
	$mail->Password=Config::get('mailarr.password');//客户端的授权密码
	//发送邮件的主题
	$mail->Subject=$title;
	//内容类型 文本型
	$mail->AltBody="text/html";
	//发送的内容
	$mail->Body=$content;
	//设置内容是否为html格式
	$mail->IsHTML(true);
	//设置接收方
	$mail->AddAddress(trim($to));
	if(!$mail->Send()){
		return false;
		// echo "失败".$mail->ErrorInfo;
	}else{
		return true;
	}
}
//导入系统类 Loader
use think\Loader;
//通过import
function Wxpays(){
	Loader::import("Org.Util.Wxpay");

	//实例化
	$wx=new Wxpay();
	// echo "<pre>";
	// var_dump($wx);
	$wx->wxpays();
}

//通过Vendor() 导入三方类
function func(){
	Vendor("libs.Phones");
	//实例化
	$ppp=new Phones();
	// echo "<pre>";
	// var_dump($ppp);
	$ppp->sendsss();
}

//短信校验码获取
function funcs($p){
//导入三方类
Vendor("lib.Ucpaas");
//初始化必填
//填写在开发者控制台首页上的Account Sid
$options['accountsid']='xxxxxxxxxxxxxxx';
//填写在开发者控制台首页上的Auth Token
$options['token']='xxxxxxxxxxxx';

//初始化 $options必填
$ucpass = new Ucpaas($options);

$appid = "xxxxxxxxx";	//应用的ID，可在开发者控制台内的短信产品下查看
//模板id
$templateid = "327219";    //可在后台短信产品→选择接入的应用→短信模板-模板ID，查看该模板ID
//校验码
$param =rand(1,10000); //多个参数使用英文逗号隔开（如：param=“a,b,c”），如为参数则留空
//存储在cookie  60秒后过期
setcookie("fcode",$param,time()+60);
//接受的手机号
$mobile = $p;
$uid = "";

//70字内（含70字）计一条，超过70字，按67字/条计费，超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。

echo $ucpass->SendSms($appid,$templateid,$param,$mobile,$uid);
}
