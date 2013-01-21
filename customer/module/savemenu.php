
<?php
header('Content-Type: text/html; charset=utf-8');

include '../../db/db_open.php';


$dishes = $_POST['dish'];

for ($i=0; $i<count($dishes); $i++){
	$row = $dishes[$i];
	print_r($row);
	if ($row != ''){
		$query_string .= " ('".$row["name"]."', ".$row["price"].", ".$row["type"]."),"; 
	}
}

//删除最后的逗号
$query_string = substr_replace($query_string,"",-1);
//合成sql语句
$query_string = "insert into dish(name,price,type) values ".$query_string.";"; 
//插入数据库
$r = mysql_query($query_string);
if (!$r){
  die('插入Error: ' . mysql_error());
}
echo "插入sql语句*********".$query_string;

include '../../db/db_close.php';
?>