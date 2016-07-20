<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use app\models\WeReply;
use app\models\WeAccount;

class ReplyController extends Controller
{
	/**
	 * 跳转页面
	 */
	public $layout="menu.php";
	public $enableCsrfValidation = false;
	/**
	 * 自定义回复的增删改查
	 */
	public function actionReply()
	{
		$request=Yii::$app->request->method;
		$requests=Yii::$app->request;
		$db=\Yii::$app->db;
		if ($request!="POST") {

				$arr=WeAccount::find()->asArray()->all();
				//print_r($arr);die;
				return $this->render('reply',['arr'=>$arr]);

		} else {
			$connection=\Yii::$app->db;
			$arr=\Yii::$app->request->post();
			$connection->createCommand()->insert('we_reply', [
				    'aid' => $arr['aid'],
				    'rename' => $arr['rename'],
				    'rekeyword'=>$arr['rekeyword'],
				])->execute();
				$reid=$connection->getLastInsertID();
				//$reid=$connection->getLastInsertID();
				$connection->createCommand()->insert('we_text_reply', [
				    'reid' => "$reid",
                     'trcontent'=>$arr['trcontent'],
				])->execute();
			return $this->redirect("index.php?r=reply/show");		

			}
	}
	/**
	 * 查询列表
	 */
	public function actionShow()
	{		
          $data =WeReply::find()->select('*')->innerJoin('we_text_reply','we_text_reply.reid=we_reply.reid'); //联查  
           $pages = new Pagination(['totalCount' =>$data->count(), 'pageSize' => '3']);  
           $model = $data->offset($pages->offset)->limit($pages->limit)->asArray()->all(); //分页  
           return $this->render('show',[  
                 'model' => $model,  
                 'pages' => $pages,  
           ]);
	}
	/**
	 * 删除的方法
	 */
	public function actionDele()
	{
	   $requests=Yii::$app->request;
	   $db=\Yii::$app->db;
		//结值方式
	    $id=$requests->get("id");
		$db->createCommand()->delete('we_reply',['reid'=>$id])->execute();
        $db->createCommand()->delete('we_text_reply',['reid'=>$id])->execute();
	   return $this->redirect("index.php?r=reply/show");

	}
	/**
	 * 默认值页面
	 */
	public function actionUp()
	{
	    $requests=Yii::$app->request;
	    $db=\Yii::$app->db;
		//结值方式
	    $id=$requests->get("id");
	    //print_r($arr);die
	   $sql="select from we_reply where reid=$id";
	   print_r($sql);die;
	    //联查   
        $model = $data->offset($pages->offset)->limit($pages->limit)->asArray()->all(); 
	}
}
