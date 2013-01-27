<?php
header('Content-Type: text/html; charset=utf-8');

include_once $_SERVER['DOCUMENT_ROOT'].'/db/db_open.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/publicLib/Order.php';

$orderstatus = $_POST['status'];
$orderid = $_POST['id'];

$order = new Order('','','','','');
$result = $order->updateStatus($orderid,$orderstatus);

if ($result){
    $obj->status = 1;
    if($orderstatus==0){
    	$obj->statusText = '删除成功';
	}elseif ($orderstatus == 2 ){
		$obj->statusText = '马上开始送餐';
	}elseif ($orderstatus==3) {
		$obj->statusText = '已经标记为无效订单';
	}
}else{
    $obj->status = 0;
    $obj->statusText = '更新失败';
}

echo json_encode($obj);
include $_SERVER['DOCUMENT_ROOT'].'/db/db_close.php';
?>