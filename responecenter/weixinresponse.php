<?php
/**
  * wechat php test
  */
include $_SERVER['DOCUMENT_ROOT'].'/db/db_open.php';
//包含分页类
include $_SERVER['DOCUMENT_ROOT'].'/publicLib/page.php';

include $_SERVER['DOCUMENT_ROOT'].'/responecenter/responemenulist.php';
include $_SERVER['DOCUMENT_ROOT'].'/responecenter/responestorelist.php';
//define your token
define("TOKEN", "shejian");

class wechatCallbackapiTest
{
	public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }

    public function responseMsg()
    {
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

      	//extract post data
		if (!empty($postStr)){
                
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
                $time = time();
                $msgType = $postObj->MsgType;
                $textTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                             <MsgType><![CDATA[%s]]></MsgType>
                             <Content><![CDATA[]]></Content>
                             <ArticleCount>3</ArticleCount>
                             <Articles>%s</Articles>
                             <FuncFlag>0</FuncFlag>
                             </xml>";           
				if(!empty( $keyword ))
                {
                    if($msgType=="text"){
                        $contentStr = $this->responseMenus();
                    }elseif ($msgType=="location") {
                        $contentStr = $this->responseStores();
                    }
              		$msgType = "news";
                	//$contentStr = "欢迎来到舌尖网,马上为您预订".$keyword;
                	$resultStr = sprintf($textTpl, $toUsername, $fromUsername, $time, $msgType, $contentStr);
                	echo $resultStr;
                }else{
                	echo "Input something...";
                }

        }else {
        	echo "";
        	exit;
        }
    }
	
    private function responseMenus(){
        return getMenus(1);
    }
    private function responseStores(){
        return getStores(1);
    }

	private function checkSignature()
	{
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];	
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr);
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


