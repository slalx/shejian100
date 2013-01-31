<?php
header('Content-Type: text/html; charset=utf-8');

include_once $_SERVER['DOCUMENT_ROOT'].'/db/db_open.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/publicLib/Order.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/publicLib/UsersInfo.php';
//包含短信发送的类
//define('SCRIPT_ROOT',  dirname(__FILE__).'/');
require_once $_SERVER['DOCUMENT_ROOT'].'/sms/demo_gbk.php';
date_default_timezone_set("Asia/Chongqing");

$restaurantid = $_POST['restaurantid'];
$ordercountid = $_POST['ordercountid'];
$fromuserid = $_POST['fromuserid'];
$addressid = $_POST['addressid'];
$telephoneid = $_POST['telephoneid'];
$chusername = $_POST['chusername'];

//提交订单
$order = new Order($fromuserid,$restaurantid ,$ordercountid,$addressid,$telephoneid,$chusername);

$smsContent = '姓名:'.$chusername.';地址:'.$addressid.';电话:'.$telephoneid.';订单:'.$ordercountid;

if($order->save()){
	if(sendSMS($smsContent)==0){
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