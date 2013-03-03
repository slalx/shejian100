<?php
header('Content-Type: text/html; charset=utf-8');

include_once $_SERVER['DOCUMENT_ROOT'].'/db/db_open.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/publicLib/Order.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/publicLib/UsersInfo.php';
//包含短信发送的类
//define('SCRIPT_ROOT',  dirname(__FILE__).'/');
require_once $_SERVER['DOCUMENT_ROOT'].'/sms/demo_gbk.php';
date_default_timezone_set("Asia/Chongqing");


  function getorderliststr($ordercount){
    $listTpl = "%s:%s份 ";
	  if($ordercount){
	     $orderarr = explode("*",$ordercount);
	     $restaurantid = $_POST['restaurantid'];
	     for($i=0; $i <count($orderarr); $i++){
	        $order = $orderarr[$i];
	        $menuidandcount = explode(":",$order);
	        $menuid = $menuidandcount[0];
	        $menucount = $menuidandcount[1];
	        $typeresult = mysql_query("select * from dish where restaurantid=$restaurantid and id=$menuid;");
	        if ($typeresult != false){
	          while($row = mysql_fetch_array($typeresult)){
	            $name = $row["name"];
	            $liststr.= sprintf($listTpl, $name,$menucount);     

	          }
	        }
	     } 
	     return   $liststr;
	  }
  }


$restaurantid = $_POST['restaurantid'];
$ordercountid = $_POST['ordercountid'];
$fromuserid = $_POST['fromuserid'];
$addressid = $_POST['addressid'];
$telephoneid = $_POST['telephoneid'];
$chusername = $_POST['chusername'];
$mobiletelephone = $_POST['mobiletelephone'];

//提交订单
$order = new Order($fromuserid,$restaurantid ,$ordercountid,$addressid,$telephoneid,$chusername);



$ordercountstr = getorderliststr($ordercountid);


$smsContent = '姓名:'.$chusername.';地址:'.$addressid.';电话:'.$telephoneid.';订单:'.$ordercountstr;

if($order->save()){
	if(sendSMS($smsContent,$mobiletelephone)==0){
		$obj->status = 1;
		$obj->statusText = '订单提交成功';
	}else{
		$obj->status = 0;
		$obj->statusText = '短信发送失败，请重新提交订单';		
	}
}else{
	$obj->status = 0;
	$obj->statusText = '服务器端发生错误，请稍后再试';	
}



echo json_encode($obj);

include_once $_SERVER['DOCUMENT_ROOT'].'/db/db_close.php';
?>