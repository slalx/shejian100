<?php
header('Content-Type: text/html; charset=utf-8');
session_start(); 
include $_SERVER['DOCUMENT_ROOT'].'/db/db_open.php';


$old_password = $_POST['old_password'];
$new_password = $_POST['new_password'];

$customerid = $_COOKIE["sj_uid"];

//合成sql语句
$query_string = "select * from store where id='$customerid'"; 
//插入数据库
$result = mysql_query($query_string);
$numrows=mysql_num_rows($result); 

if ($numrows == 1){
  //die('插入Error: ' . mysql_error());
	//
	$row=mysql_fetch_assoc($result);  
    $upassword = $row[upassword];
    if($old_password == $upassword){
        $issavesucc = mysql_query("update store set  upassword='$new_password' where id='$customerid'");
        if($issavesucc){
            $obj->status = 1;
            $obj->uid = $row[id];
            $obj->statusText = '密码修改成功';
        }else{
            $obj->status = 0;
            $obj->uid = $row[id];
            $obj->statusText = '服务器出现错误';
        }
    }else{
            $obj->status = 0;
            $obj->uid = $row[id];
            $obj->statusText = '旧密码错误';
    }
}

echo json_encode($obj);
include $_SERVER['DOCUMENT_ROOT'].'/db/db_close.php';
?>