<?php
/**
 * wechat php test
 */

//define your token
/*

{"access_token":"OwsqgwRBNxXYMDQaRbTanAAr3VDXZeG0OLTdSBhiKDeu1veRgzQXncD6PghmKKG9_4C76SaXGiHNE4t3KuABDE1mO-WazUujBuNga2i_X8i2HDzsV8IttWUw8pBptzCoSGVgAIAHVK","expires_in":7200}
*/
$str=$_GET['str'];
include_once("./web/assets/abc.php");
$pdo ->query("set names utf8");
$rs = $pdo->query("SELECT * FROM we_account where atok ='$str'");
$result_arr = $rs->fetchAll();
foreach($result_arr as $val){
    $token=$val['atoken'];
    $tok=$val['atok'];
    $url=$val['aurl'];
    $id=$val['aid'];
}
define("ID","$id");
define("TOKEN", "$token");
$wechatObj = new wechatCallbackapiTest();
$wechatObj->valid($pdo);

class wechatCallbackapiTest
{
    public function valid($pdo)
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
            echo $echoStr;
            $this->responseMsg($pdo);
            exit;
        }
    }

    public function responseMsg($pdo)
    {
        //get post data, May be due to the different environments
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

        //extract post data
        if (!empty($postStr)){
            /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
               the best way is to check the validity of xml by yourself */
            libxml_disable_entity_loader(true);
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUserName;
            $keyword = trim($postObj->Content);
            $time = time();
            $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";

            $imgTpl="<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <Image>
                            <MediaId><![CDATA[%s]]></MediaId>
                            </Image>
                            </xml>";
            if(!empty( $keyword ))
            {
                $re=$pdo->query("select trcontent from we_reply inner join we_text_reply on we_reply.reid = we_text_reply.reid where rekeyword='$keyword' and aid=".ID)->fetchAll();
                if($re[0]['trcontent']){
                    $msgType = "text";
                    $contentStr =$re[0]['trcontent'];
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    echo $resultStr;
                }elseif($keyword=="123"){
                    $msgType = "image";
                    $mediaId="JAyhzKxborj8qNI2vO4-ZoQRTj9uNMkv3vpanG5Sf6NNxShHAfarrzYFGFBFOJUA";
                    $resultStr = sprintf($imgTpl, $fromUsername, $toUsername, $time, $msgType, $mediaId);
                    echo $resultStr;
                }else{
                    $url="http://www.tuling123.com/openapi/api?key=714b254b68330494707e406e7c0a3f9d&info='$keyword'";
                    $a=file_get_contents($url);
                    $arr=json_decode($a);
                    $c=$arr->text;
                    $msgType = "text";
                    $contentStr =$c;
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    echo $resultStr;
                }

            }else{
                echo "Input something...";
            }
        }else {
            echo "";
            exit;
        }
    }
    private function checkSignature()
    {
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }

        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }
}
?>

