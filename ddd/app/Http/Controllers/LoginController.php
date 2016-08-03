<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Requests;
use Illuminate\Support\Facades\DB;


class LoginController extends Controller
{
    public function index(){
        if(session("key")){
            echo "1登录成功";
        }else{
            return view("login");
        }
    }
    public function login(Request $request){
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
}
