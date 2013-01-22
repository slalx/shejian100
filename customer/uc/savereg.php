<?php
header('Content-Type: text/html; charset=utf-8');
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
echo "插入sql语句*********".$query_string;
//插入数据库

$r = mysql_query($query_string);
if (!$r){
  die('插入Error: ' . mysql_error());
}
echo "插入sql语句*********".$query_string;

include $_SERVER['DOCUMENT_ROOT'].'/db/db_close.php';
?>