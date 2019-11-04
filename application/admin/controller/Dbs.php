<?php
namespace app\admin\controller;
//导入系统Config
use think\Config;
use think\Controller;
use think\Db;
class Dbs extends Controller
{   
    //后台用户模块列表
    public function getindex()
    {
        //数据库的基本操作
        //获取数据
    //     $data=Db::query("select * from user");
    //     echo "<pre>";
    //     var_dump($data);
        $res = Db::table("user")->select();
        echo "<pre>";
        var_dump($res);
    }


    
}
