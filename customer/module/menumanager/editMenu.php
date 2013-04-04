<?php
header('Content-Type: text/html; charset=utf-8');
session_start(); 
include $_SERVER['DOCUMENT_ROOT'].'/db/db_open.php';


$id = $_POST['id'];
$price = $_POST['price'];
$name = $_POST['name'];
$type = $_POST['type'];

if(empty($price) || empty($name)){
	$obj->status = 0;
    $obj->statusText = '输入不能为空';
	echo json_encode($obj);
	exit(0);
}

$restaurantid = $_COOKIE["sj_uid"];

//合成sql语句
$query_string = "update dish set name='$name', price='$price', type='$type'   where id = $id"; 

//插入数据库
$result = mysql_query($query_string);

if ($result){
    $obj->status = 1;
    $obj->statusText = '修改成功';
}else{
    $obj->status = 0;
    $obj->statusText = '修改失败';
}

echo json_encode($obj);
include $_SERVER['DOCUMENT_ROOT'].'/db/db_close.php';
?>