<?php
header('Content-Type: text/html; charset=utf-8');

include_once $_SERVER['DOCUMENT_ROOT'].'/db/db_open.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/publicLib/Order.php';

$orderstatus = $_POST['status'];
$orderid = $_POST['id'];

$order = new Order('','','','','','');
$result = $order->updateStatus($orderid,$orderstatus);

if ($result){
    $obj->status = 1;
    if($orderstatus==3){
    	$obj->statusText = '删除成功';
	}elseif ($orderstatus == 2 ){
		$obj->statusText = '开始送餐';
	}
}else{
    $obj->status = 0;
    $obj->statusText = '服务失败，请稍后';
}

echo json_encode($obj);
include $_SERVER['DOCUMENT_ROOT'].'/db/db_close.php';
?>