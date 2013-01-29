<?php
header('Content-Type: text/html; charset=utf-8');

include $_SERVER['DOCUMENT_ROOT'].'/db/db_open.php';
include $_SERVER['DOCUMENT_ROOT'].'/publicLib/FeedBack.php';

$restaurantid = $_POST['restaurantid'];
$feedbackcontent = $_POST['feedbackcontent'];
$fromuserid = $_POST['fromuserid'];

$feedBack = new FeedBack($fromuserid,$restaurantid ,$feedbackcontent);
        $feedBack->save();

$obj->status = 1;
$obj->statusText = '保存成功';

echo json_encode($obj);

include $_SERVER['DOCUMENT_ROOT'].'/db/db_close.php';
?>