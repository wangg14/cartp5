<?php

//导入路由类 use 导入
use think\Route;


/**
 * 后台
 */
//后台登录
Route::controller("/adminlogin","admin/Login");
//搭建后台实例
Route::controller("/admin","admin/Admin");
//后台用户模块
Route::controller("/adminuser","admin/Users");
//分类
Route::controller("/admincates","admin/Cate");
//管理员模块
Route::controller("/adminusers","admin/Adminss");
//前台首页
Route::controller("/homeindex","index/Index");
//列表
Route::controller("/homelists","index/Lists");
//测试widget
Route::controller("/homeindexs","index/Index1");
//后台公告模块
Route::controller("/adminarticles","admin/Articles");
//角色管理
Route::controller("/adminrolelist","admin/Rolelist");
//权限管理
Route::controller("/adminlists","admin/Lists");










/**
 * 前台
 */

//前台
//前台注册
Route::controller("/homeregister","index/Register");
//前台登录
Route::controller("/homelogin","index/Login");



