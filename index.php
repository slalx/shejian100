<!doctype html>
<html >
<head>
<meta charset="utf-8" />
<title></title>
</head>
<body>
	<div>我是张胜利</div>
<?php 


require '/db/db_open.php';

/*$name = $_POST["name"];
echo $name."我传第的名字<br>";
// 插入
$q = "insert into restaurant(name) VALUES ('".$name."')";
echo $q."sql语句<br>";
$r = mysqli_query($dbc,$q);
printf("insert success<br>");

// 查询
$qq = "select * from restaurant";
$result = mysqli_query($dbc,$qq);

if( $result ){
	while ($row = mysqli_fetch_array($result)) {
		echo $row['id'];
		echo $row['name'];
	}
}else{
	echo "why no result<br>";
}

// 修改
$qu = "update restaurant set name='guolin' where id=1";
$result = mysqli_query($dbc,$qu);
if($result){
	echo "updata success<br>";
}else{
	echo "updata fail<br>";
}

// 删除
$qu = "delete from restaurant where id=6";
$result = mysqli_query($dbc,$qu);
if($result){
	echo "delete success<br>";
}else{
	echo "delete fail<br>";
}
*/

require '/db/db_close.php';

?>
</body>
</html>

