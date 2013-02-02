<?php
header('Content-Type: text/html; charset=utf-8');
session_start(); 
include $_SERVER['DOCUMENT_ROOT'].'/db/db_open.php';

$store_name = $_POST['store_name'];
//$store_address = $_POST['store_address'];
$store_ownername = $_POST['store_ownername'];
$store_mobilephone = $_POST['store_mobilephone'];
$store_telephone = $_POST['store_telephone'];
$store_latitude = $_POST['store_latitude'];
$store_longitude = $_POST['store_longitude'];
$store_desc = $_POST['store_desc'];

$restaurantid = $_COOKIE["sj_uid"];


	//合成sql语句

	$query_string = "update store set name='$store_name',ownername='$store_ownername',mobilephone='$store_mobilephone',telephone='$store_telephone',latitude='$store_latitude',longitude='$store_longitude',storedesc='$store_desc' where id= $restaurantid "; 
	//插入数据库
	$r = mysql_query($query_string);
	if (!$r){
		$obj->status = 0;
		$obj->statusText = '修改店铺信息失败，请稍后再试';
	  //die('插入Error: ' . mysql_error());
	}else{
		    $obj->status = 1;
	    	$obj->statusText = '修改成功';
	}

echo json_encode($obj);

include $_SERVER['DOCUMENT_ROOT'].'/db/db_close.php';
?>