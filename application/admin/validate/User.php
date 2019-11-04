<?php
namespace app\admin\validate;
//导入Validate 类
use think\Validate;
//定义验证器类
class User extends Validate{
	//设置规则
	protected $rule=[
						//用户规则 require 验证某个字段必须  regex  检验某个参数是否符合正则 unique 校验字段是否唯一 users 数据表
						"username"=>"require|regex:\w{4,8}|unique:users",
						"password"=>"require|regex:\w{6,18}",
						"repassword"=>"require|regex:\w{6,18}|confirm:password",
						"email"=>"require|email|unique:users",
						"phone"=>"require|regex:\d{11}|unique:users",

					];
	//规则提示信息
	protected $message=[
						"username.require"=>"用户名不能为空",
						"username.regex"=>"用户名必须为4-8位任意数字字母下划线",
						"username.unique"=>"用户名重复",
						"password.require"=>"密码不能为空",
						"password.regex"=>"密码必须为6-18位任意的数字字母下划线",
						"repassword.require"=>"重复密码不能为空",
						"repassword.regex"=>"重复密码必须为6-18位任意的数字字母下划线",
						"repassword.confirm"=>"两次密码不一致",
						"email.require"=>"邮箱不能为空",
						"email.email"=>"邮箱不符合格式",
						"email.unique"=>"邮箱重复",
						"phone.require"=>"电话不能为空",
						"phone.regex"=>"电话不符合格式",
						"phone.unique"=>"电话重复",
						];
}
 ?>