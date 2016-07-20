<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;


class InstallController extends Controller
{
    public $enableCsrfValidation = false;
    public function actionIndex(){
        //安装第一个页面，同意协议
        //判断是否安装
        if(is_file("assets/existence.php")){
            $this->redirect("index.php?r=index/lsts");
        }else{
            return $this->renderPartial("one");
        }
    }
    public function actionTwo()
    {

        return $this->renderPartial("two");
    }
    public function actionThree(){
        return $this->renderPartial("three");
    }
    public function actionInstall(){
        $post=\Yii::$app->request->post();
        $host=$post['dbhost'];
        $name=$post['dbname'];
        $pwd=$post['dbpwd'];
        $db=$post['db'];
        $uname=$post['uname'];
        $upwd=$post['upwd'];
        if (@$link= mysql_connect("$host","$name","$pwd")){
            $db_selected = mysql_select_db("$db", $link);
            if($db_selected){
                $sql="drop database ".$post['db'];
                mysql_query($sql);
            }
            $sql="create database ".$post['db'];
            mysql_query($sql);
            $file=file_get_contents('./assets/yan.sql');
            $arr=explode('-- ----------------------------',$file);
            $db_selected = mysql_select_db($post['db'], $link);
            for($i=0;$i<count($arr);$i++){
                if($i%2==0){
                    $a=explode(";",trim($arr[$i]));
                    array_pop($a);
                    foreach($a as $v){
                        mysql_query($v);
                    }
                }
            }
            $str="<?php
					return [
						'class' => 'yii\db\Connection',
						'dsn' => 'mysql:host=".$post['dbhost'].";port=3306;dbname=".$post['db']."',
						'username' => '".$post['dbname']."',
						'password' => '".$post['dbpwd']."',
						'charset' => 'utf8',
						'tablePrefix' => 'we_',   //加入前缀名称we_
					];";
            file_put_contents('../config/db.php',$str);
            $str1="<?php
                \$pdo=new PDO('mysql:host= $host;port=3306;dbname=$db','$name','$pwd',array(PDO::MYSQL_ATTR_INIT_COMMAND=>'set names utf8'));
                   ?>";
            file_put_contents('./assets/abc.php',$str1);
            $sql="insert into we_user (uname,upwd) VALUES ('$uname','$upwd')";
            mysql_query($sql);
            $sql1="insert into we_ip (iip,iuser) VALUES ('127.0.0.1','$uname')";
            mysql_query($sql1);
            mysql_close($link);
            $counter_file       =   'assets/existence.php';//文件名及路径,在当前目录下新建锁
            $fopen                     =   fopen($counter_file,'wb');//新建文件命令
            fputs($fopen,   'aaaaaa ');//向文件中写入内容;
            fclose($fopen);
            $strs=str_replace("//'db' => require(__DIR__ . '/db.php'),","'db' => require(__DIR__ . '/db.php'),",file_get_contents("../config/web.php"));
            file_put_contents("../config/web.php",$strs);
            $this->redirect("index.php?r=index/lsts");
        }else{
            echo "<script>
                        if(alert('数据库账号或密码错误')){
                             location.href='index.php?r=install/three';
                        }else{
                            location.href='index.php?r=install/three';
                        }
            </script>";
        }
    }
}