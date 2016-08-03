<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Requests;
use Illuminate\Support\Facades\DB;


class LoginController extends Controller
{
    public function anyIndex(){
        if(session("key")){
            echo "1登录成功";
        }else{
            return view("login");
        }
    }
    public function anyLogin(Request $request){
        $name=$request->input("name");
        $pwd=$request->input("pwd");
        $data=DB::table("demo")->where(['name'=>$name,'pwd'=>$pwd])->get();
        if(empty($data)){
            echo "账号密码错误";
        }else{
            echo "2登录成功";
            session(['key' => 'value']);
            echo session("key");
        }
    }
    public function anyCheck(){
        $a="NSLayoutCanstraint";
        //首先对字符串进行了反转和大小写切换
        $b=strtolower(strrev($a));
        //在对字符串的前三位变成大写
        $c=substr_replace($b,substr(str_replace($b,strtoupper($b),$b),0,3),0,3);;
        //获取字符串的中间的第九位变成大写
        $d=substr(str_replace($b,strtoupper($b),$b),8,1);
        //在把中间的第九位替换掉
        echo substr_replace($c,$d,8,1);
    }
}
