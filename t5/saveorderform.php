<?php
header('Content-Type: text/html; charset=utf-8');

include $_SERVER['DOCUMENT_ROOT'].'/db/db_open.php';
include $_SERVER['DOCUMENT_ROOT'].'/publicLib/Order.php';

$restaurantid = $_POST['restaurantid'];
$ordercountid = $_POST['ordercountid'];
$fromuserid = $_POST['fromuserid'];
$addressid = $_POST['addressid'];
$telephoneid = $_POST['telephoneid'];

$order = new Order($fromuserid,$restaurantid ,$ordercountid,$addressid,$telephoneid);
        $order->save();

$obj->status = 1;
$obj->statusText = '保存成功';

echo json_encode($obj);

include $_SERVER['DOCUMENT_ROOT'].'/db/db_close.php';
?>