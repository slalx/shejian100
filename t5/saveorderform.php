<?php
header('Content-Type: text/html; charset=utf-8');

include $_SERVER['DOCUMENT_ROOT'].'/db/db_open.php';
include $_SERVER['DOCUMENT_ROOT'].'/publicLib/Order.php';
include $_SERVER['DOCUMENT_ROOT'].'/publicLib/UsersInfo.php';

$restaurantid = $_POST['restaurantid'];
$ordercountid = $_POST['ordercountid'];
$fromuserid = $_POST['fromuserid'];
$addressid = $_POST['addressid'];
$telephoneid = $_POST['telephoneid'];
$chusername = $_POST['chusername'];

//提交订单
$order = new Order($fromuserid,$restaurantid ,$ordercountid,$addressid,$telephoneid,$chusername);
        
if($order->save()){
	$obj->status = 1;
	$obj->statusText = '订单提交成功';
}else{
	$obj->status = 0;
	$obj->statusText = '服务器端发生错误，请稍后再试';	
}



echo json_encode($obj);

include $_SERVER['DOCUMENT_ROOT'].'/db/db_close.php';
?>