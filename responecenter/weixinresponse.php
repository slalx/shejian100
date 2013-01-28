<?php
/**
  * wechat php test
  */
include $_SERVER['DOCUMENT_ROOT'].'/db/db_open.php';
//包含分页类
include $_SERVER['DOCUMENT_ROOT'].'/publicLib/page.php';

include $_SERVER['DOCUMENT_ROOT'].'/responecenter/responemenulist.php';
include $_SERVER['DOCUMENT_ROOT'].'/responecenter/responestorelist.php';
//
include $_SERVER['DOCUMENT_ROOT'].'/publicLib/Order.php';
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
                $time = time();
                $content = "";
                $msgType = $postObj->MsgType;
                if($msgType == "text"){
                    $keyword = trim($postObj->Content);
                }elseif ($msgType == "location"){
                    $keyword = $postObj->Label;
                }
                $textTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                             <MsgType><![CDATA[%s]]></MsgType>
                             <Content><![CDATA[%s]]></Content>
                             %s
                             <FuncFlag>0</FuncFlag>
                             </xml>";           
				if(!empty( $keyword ))
                {
                    
                    if($msgType == "text"){
                        //默认仅仅处理饭店的id
                        $msgType = "news";
                        $articlesStr = $this->responseMenus($keyword,$fromUsername);
                        //如果含有#号，则认为提交的信息为订单信息
                        //如果返回的信息含有！【感叹号】，则认为没有找到要查找的餐馆
                        if(strpos($keyword,'#') !== false || strpos($articlesStr,'!!!') !== false){
                            $content = $articlesStr;
                            $articlesStr = '';
                            $msgType = "text";
                        }
                    }elseif ($msgType == "location") {
                        //提交的地理信息，帮您搜寻您旁边的饭店
                        $msgType = "news";
                        $articlesStr = $this->responseStores($postObj->Location_X,$postObj->Location_Y,$fromUsername);
                    }
              		
                	//$contentStr = "欢迎来到舌尖网,马上为您预订".$keyword;
                	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType,$content,$articlesStr);
                	echo $resultStr;
                }else{
                	echo "Input something...";
                }

        }else {
        	echo "";
        	exit;
        }
    }
	//根据饭店id查询菜单或者保存订单信息
    private function responseMenus($keyword,$fromUsername){
        $content ='';

        if(strpos($keyword,'#') === false){
            $content =  getMenus(1,$keyword);
        }else{
            $content = $this->saveOrderInfor($keyword,$fromUsername);
        }
        return $content;
    }
    //根据地理位置查询饭店列表
    private function responseStores($Location_X,$Location_Y,$fromUsername){
        return getStores(1,$Location_X,$Location_Y,$fromUsername);
    }

    //
    //根据#号表示订餐完成
    private function saveOrderInfor($infomation,$fromUsername){
    //#饭店编号#13:2*14:3#地址#手机号3#13:2 14:3#北京市海淀区#15901227752
        $infoarr = explode("#",$infomation);
        $restaurantid = $infoarr[0];
        $ordercount = $infoarr[1];
        $address = $infoarr[2];
        $telepone = $infoarr[3];
        
        $order = new Order($fromUsername,$restaurantid ,$ordercount,$address,$telepone);
        $order->save();
        return "订餐成功，预计一个小时送到";     
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


