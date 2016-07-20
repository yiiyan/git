<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;


class MenuController extends Controller
{
    public $enableCsrfValidation = false;
    public function actionIndex(){
        //展示菜单模板
        $arr=\Yii::$app->db->createCommand("select * from we_account ")->queryAll();
        return $this->renderPartial("index",["arr"=>$arr]);
    }
    public function actionMenu(){
        //接受菜单的传来的值，进行菜单的修改
        $data=\Yii::$app->request->post();
        $id=$data['di'];
        $arr=\Yii::$app->db->createCommand("select * from we_account where aid=$id")->queryAll();
        $appid=$arr[0]['appid'];
        $appsecret=$arr[0]['appsecret'];
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $jsoninfo = json_decode($output, true);
        $access_token = $jsoninfo["access_token"];
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=$access_token";
        $method="POST";
        $data=$data['do'];
        echo $this->actionCurl($url,$method,$data);

    }
    public function actionCurl($url,$method,$data){
        $ch = curl_init();   //1.初始化
        curl_setopt($ch, CURLOPT_URL, $url); //2.请求地址
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);//3.请求方式
        //4.参数如下
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);//https
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');//模拟浏览器
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER,array('Accept-Encoding: gzip, deflate'));//gzip解压内容
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');

        if($method=="POST"){//5.post方式的时候添加数据
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $tmpInfo = curl_exec($ch);//6.执行

        if (curl_errno($ch)) {//7.如果出错
            return curl_error($ch);
        }
        return $tmpInfo;
        curl_close($ch);//8.关闭
    }
}