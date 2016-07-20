<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\WeAccount;
use yii\data\Pagination;
class AccountController extends Controller
{
	/**
	 * 跳转页面
	 */
	public $layout="menu.php";
	public $enableCsrfValidation = false;
	/**
	 * 公众号的增删改查
	 */
	public function actionAdd()
	{
		$request=Yii::$app->request->method;
		$requests=Yii::$app->request;
		$db=\Yii::$app->db;
		if ($request!="POST") {
            return $this->render("add");
        } else {
			$aname=$requests->post('aname');
			$account=$requests->post('account');
			$appid=$requests->post('appid');
			$appsecret=$requests->post('appsecret');
            $atoken=md5(rand(1000,9999));
            $atok = $this->actionRand(10);
            $aurl=substr('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],0,strpos('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],'we'))."wx_sample.php?str=".$atok;
            //$aurl=substr('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],0,strpos('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],'?'))."?r=account/tokenurl&ss=".$atok;
			//print_r($aname);
			$db->createCommand()->insert('we_account', [
                'aname'=>$aname,
                'account'=>$account,
                'appid'=>$appid,
                'appsecret'=>$appsecret,
                'atoken'=>$atoken,
                'atok'=>$atok,
                'atoken'=>$atoken,
                'aurl'=>$aurl,
            ])->execute();
            return $this->redirect("index.php?r=account/show");
		}
	}
	/**
	 * 公众号的列表
	 */
	public function actionShow()
	{
		$query = WeAccount::find();
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $arr = $query->orderBy('aname')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('show', [
            'arr' => $arr,
            'pagination' => $pagination,
        ]);
    }
	/**
	 * ip删除
	 */
    public function actionDel(){
       $requests=Yii::$app->request;
	   $db=\Yii::$app->db;
		//结值方式
	   $id=$requests->get("id");
	   //print_r($id);die;
		//sql语句
       $db->createCommand()->delete('we_account',['aid'=>$id])->execute();
	   return $this->redirect("index.php?r=account/show");
    }
	/**
	 * 编辑修改默认值页面
	 */
	public function actionUp()
	{
	     $requests=Yii::$app->request;
	     $db=\Yii::$app->db;
		//结值方式
	    $id=$requests->get("id");
	    $sql="select * from we_account where aid='$id'";
	    $arr=$db->createCommand($sql)->queryOne();

		//print_r($arr);die;
		return $this->render('up',['arr'=>$arr]);
	}
	/**
	 * 编辑修改结值页面
	 */
	public function actionAdds()
	{
		$request=Yii::$app->request->method;
		$requests=Yii::$app->request;
		$db=\Yii::$app->db;
		//var_dump($_POST);die;
		$id=$requests->post("id");
		//print_r($id);die;
		$aname=$requests->post('aname');
		$account=$requests->post('account');
		$appid=$requests->post('appid');
		$appsecret=$requests->post('appsecret');
		//sql语句
		 $db->createCommand()->update('we_account',['aname'=>$aname,'account'=>$account,'appid'=>$appid,'appsecret'=>$appsecret],['aid'=>$id])->execute();
        return $this->redirect("index.php?r=account/show");
    }
  //切换
    public function actionQie(){
        $request = Yii::$app->request;
        $connection = \Yii::$app->db;
        $id =  $request->get("id");
       // echo $id;die;
        //调用session
        $session = Yii::$app->session;
        $session->open();
        $session->set("aid",$id);
       //echo  $session->get("aid");die;
        if($session->get("aid")){
            $this->redirect("index.php?r=account/show");
        }else{
            $this->redirect("index.php?r=account/show");
        }
    }
     public function actionTokenurl(){
        $atok = $_GET['ss'];
        $db = \Yii::$app->db;
        $as = $db->createCommand("select atoken,aid from we_account WHERE atoken = '$atok'")->queryOne();
        $token = $as['we_token'];
        $id=$as['aid'];
        //print_r($as);die;
        include 'we.php';
    }
    //生成的随机数(url)
    public function actionRand($length){
        $str = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randString = '';
        $len = strlen($str)-1;
        for($i = 0;$i < $length;$i ++)
        {
            $num = mt_rand(0, $len); $randString .= $str[$num];
        }
        return $randString ;
    }

}
