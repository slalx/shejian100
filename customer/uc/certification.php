<?php
header('Content-Type: text/html; charset=utf-8');
session_start(); 
include $_SERVER['DOCUMENT_ROOT'].'/db/db_open.php';


$owner_username = $_POST['owner_username'];
$owner_password = $_POST['owner_password'];

//合成sql语句
$query_string = "select * from store where username='$owner_username' and upassword='$owner_password'"; 
//插入数据库
$result = mysql_query($query_string);
 $numrows=mysql_num_rows($result); 

if ($numrows == 1){
  //die('插入Error: ' . mysql_error());
	//
	$row=mysql_fetch_assoc($result);  
    $_SESSION[username]=$row[username];
    //setcookie("uid", $row[id]);
    //$_SESSION[] = $row[];

    $obj->status = 1;
    //$obj->uid = $row[id];
    $obj->data=array("uid"=>$row[id],"chuname"=>$row[ownername]);
    $obj->statusText = '登陆成功';
}else{
	$obj->status = 0;
	$obj->statusText = '用户名或者密码不正确';
}

echo json_encode($obj);
include $_SERVER['DOCUMENT_ROOT'].'/db/db_close.php';
?>