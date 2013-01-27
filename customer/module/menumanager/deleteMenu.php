<?php
header('Content-Type: text/html; charset=utf-8');
session_start(); 
include $_SERVER['DOCUMENT_ROOT'].'/db/db_open.php';


$ids = $_POST['ids'];

$restaurantid = $_COOKIE["sj_uid"];

//合成sql语句
$query_string = "delete from dish where id in ($ids)"; 
//插入数据库
$result = mysql_query($query_string);

if ($result){
    $obj->status = 1;
    $obj->statusText = '删除成功';
}else{
    $obj->status = 0;
    $obj->statusText = '删除失败';
}

echo json_encode($obj);
include $_SERVER['DOCUMENT_ROOT'].'/db/db_close.php';
?>