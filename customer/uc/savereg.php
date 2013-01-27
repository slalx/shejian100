<?php
header('Content-Type: text/html; charset=utf-8');
session_start(); 
include $_SERVER['DOCUMENT_ROOT'].'/db/db_open.php';

$store_name = $_POST['store_name'];
$store_address = $_POST['store_address'];
$store_ownername = $_POST['store_ownername'];
$store_username = $_POST['store_username'];
$store_upassword = $_POST['store_upassword'];
$store_mobilephone = $_POST['store_mobilephone'];
$store_telephone = $_POST['store_telephone'];
$store_latitude = $_POST['store_latitude'];
$store_longitude = $_POST['store_longitude'];
$store_desc = $_POST['store_desc'];

//合成sql语句
$query_string = "insert into store(name,address,ownername,username,upassword,mobilephone,telephone,latitude,longitude,storedesc) values ".
				"('$store_name','$store_address','$store_ownername','$store_username','$store_upassword','$store_mobilephone','$store_telephone','$store_latitude','$store_longitude','$store_desc')"; 

//插入数据库

$r = mysql_query($query_string);
if (!$r){
	$obj->status = 0;
	$obj->statusText = '注册失败，请重新注册';
  die('插入Error: ' . mysql_error());
}else{
	//如果插入成功，就把最新的id返回过来
	$storeresult =  mysql_query("select * from store order by id desc;");
	if ($storeresult != false){
	    $row = mysql_fetch_array($storeresult);
	    $id = $row["id"]; 
	    $_SESSION[username]=$row[username];
	    $obj->status = 1;
    	$obj->uid = $row[id];
    	$obj->statusText = '注册成功';
	}
}

echo json_encode($obj);

include $_SERVER['DOCUMENT_ROOT'].'/db/db_close.php';
?>