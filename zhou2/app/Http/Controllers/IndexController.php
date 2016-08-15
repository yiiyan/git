<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class IndexController extends Controller
{
    //
    public function anyIndex(Request $request){
        $title=$request->input("title");
        if($title){
            $url="http://tts.baidu.com/text2audio?lan=zh&ie=UTF-8&spd=2&text=$title";
            echo "<script> location.href='$url'</script>";
        }
        return view("index");


    }
}
