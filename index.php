<!doctype html>
<html >
<head>
<meta charset="utf-8" />
<title></title>
</head>
<body>
	<div>我是张胜利</div>
<?php include './db/db_open.php'; ?>
<?php 

echo "包含<br>";

$name = '麻辣香锅'/*$_POST["name"]*/;
echo $name."我传第的名字<br>";
/* 插入*/


$q = "insert into restaurant(name) VALUES ('".$name."')";
echo $q."sql语句<br>";
$r = mysql_query($q);
if (!$r){
  die('Error: ' . mysql_error());
}
printf("插入了一条d记录<br>");


require DB_HOST.'/db/db_close.php';

?>
</body>
</html>

