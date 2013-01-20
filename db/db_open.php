<?php 
echo '我在php代码中开始连接数据库<br>';

echo "定义数据库的变量<br>";
DEFINE('DB_HOST','42.96.139.171');
DEFINE('DB_USER','root');
DEFINE('DB_PASSWORD','41d16801c7');
DEFINE('DB_NAME','shejian100');

echo "开始连接数据库<br>";
$con = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
if (!$con){
  die('Could not connect: ' . mysql_error());
}
mysql_select_db(DB_NAME, $con);
echo '我在php代码中连接数据库结束<br>';

/*$name = $_POST["name"];
echo $name."我传第的名字<br>";*/
/* 插入*/

/*
$q = "insert into restaurant(name) VALUES ('".$name."')";
echo $q."sql语句<br>";
$r = mysqli_query($dbc,$q);
printf("insert success<br>");
*/

/* 查询*/
/*$qq = "select * from restaurant";
$result = mysqli_query($dbc,$qq);

if( $result ){
	while ($row = mysqli_fetch_array($result)) {
		echo $row['id'];
		echo $row['name'];
	}
}else{
	echo "why no result<br>";
}*/

/* 修改*/
/*$qu = "update restaurant set name='guolin' where id=1";
$result = mysqli_query($dbc,$qu);
if($result){
	echo "updata success<br>";
}else{
	echo "updata fail<br>";
}*/

/* 删除*/
/*$qu = "delete from restaurant where id=6";
$result = mysqli_query($dbc,$qu);
if($result){
	echo "delete success<br>";
}else{
	echo "delete fail<br>";
}*/
?>

