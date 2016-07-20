<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;


class MusicController extends Controller
{
    public $layout="menu.php";
    public $enableCsrfValidation = false;
    public function actionIndex(){
        $session = \Yii::$app->session;
        $session->open();
        $re=$session->get('uname');
        $data['music']=\Yii::$app->db->createCommand("select * from we_video where v_type='1'")->queryAll();
        $data['video']=\Yii::$app->db->createCommand("select * from we_video where v_type='2'")->queryAll();
//        echo "<pre>";
//        print_r($data);die;
//        if($re){
//            return  $this->render("index",['arr'=>1,'res'=>$res]);
//        }else{
//            return  $this->render("index",['arr'=>0,'res'=>$res]);
//        }
        return $this->render("index",['data'=>$data]);
    }
    public function actionInsert(){

        $request=\Yii::$app->request->post();
        if($request){
            $type=\Yii::$app->request->post("type");
            foreach($_FILES['img']['name'] as $key =>$val){
                $data['name']=$_FILES['img']['name'][$key];
                $data['type']=$_FILES['img']['type'][$key];
                $data['tmp_name']=$_FILES['img']['tmp_name'][$key];
                $data['error']=$_FILES['img']['error'][$key];
                $data['size']=$_FILES['img']['size'][$key];
                if($data['error']>0)
                {
                    die('文件上传失败');
                }
                $tp=substr($data['name'],strrpos($data['name'],'.'));
                $mode=time().rand(1000,9999).$tp;
                $path='./assets/video/'.$mode;
                if($type==1){
                    $name=rand(1000,9999).".mp3";
                }else{
                    $name=rand(1000,9999).".mp4";
                }
                if(is_uploaded_file($data['tmp_name']))
                {
                    move_uploaded_file($data['tmp_name'],$path);
                }
                $arr=\Yii::$app->db->createCommand("insert into we_video(v_name,v_type,v_src) VALUES ('$name','$type','$path')")->execute();
            }
            if($arr){
                return $this->render("insert");
            } else{
                echo "上传失败";
            }
        }else{
            return $this->render("insert");
        }
    }
    public function actionCheck(){
        $request=\Yii::$app->request;
        $zhi=$request->post("zhi");
        $arr=\Yii::$app->db->createCommand("select * from we_video where  v_name='$zhi'")->queryAll();
        echo $arr[0]['v_src'];
    }
    public function actionChange(){
        $session = \Yii::$app->session;
        $session->open();
        $re=$session->get('uname');
        $res=\Yii::$app->db->createCommand("select * from we_video where v_type='2'")->queryAll();
        return $this->renderPartial("change",['res'=>$res]);
    }
}