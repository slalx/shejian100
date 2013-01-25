<?php
header('Content-Type: text/html; charset=utf-8');
session_start(); 
include $_SERVER['DOCUMENT_ROOT'].'/db/db_open.php';


$menutype = $_POST['menutype'];

$restaurantid = $_COOKIE["sj_uid"];

//合成sql语句
$query_string = "insert into menutype (name,restaurantid) values ('$menutype','$restaurantid')"; 
//插入数据库
$result = mysql_query($query_string);

if ($result){
    $obj->status = 1;
    $obj->statusText = '保存成功';
}else{
    $obj->status = 0;
    $obj->statusText = '保存失败';
}

echo json_encode($obj);
include $_SERVER['DOCUMENT_ROOT'].'/db/db_close.php';
?>