<?php
header('Content-Type: text/html; charset=utf-8');

include $_SERVER['DOCUMENT_ROOT'].'/db/db_open.php';


$dishes = $_POST['dish'];

for ($i=0; $i<count($dishes); $i++){
	$row = $dishes[$i];
	print_r($row);
	//目前restaurantid,和userid是同一个，是一对一的关系
	if ($row != ''){
		$query_string .= " ('".$row["name"]."', ".$row["price"].", ".$row["type"].", ".$_COOKIE[sj_uid].", ".$_COOKIE[sj_uid]."),"; 
	}
}
echo "插入sql语句*********".$query_string;
//删除最后的逗号
$query_string = substr_replace($query_string,"",-1);
echo "insert into dish(name,price,type,restaurantid,userid) values ".$query_string.";"; 
//合成sql语句
$query_string = "insert into dish(name,price,type,restaurantid,userid) values ".$query_string.";"; 
//插入数据库
$r = mysql_query($query_string);
if (!$r){
  die('插入Error: ' . mysql_error());
}
echo "插入sql语句*********".$query_string;

include $_SERVER['DOCUMENT_ROOT'].'/db/db_close.php';
?>