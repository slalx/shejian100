<!doctype html>
<html >
<head>
<meta charset="utf-8" />
<title></title>
</head>
<body>
	<div>我是张胜利</div>
<?php 

echo '我在php代码中开始连接数据库\n';

echo "定义数据库的变量\n";
DEFINE('DB_HOST','42.96.139.171');
DEFINE('DB_USER','root');
DEFINE('DB_PASSWORD','41d16801c7');
DEFINE('DB_NAME','shejian');

echo "开始连接数据库\n";
$dbc = @mysql_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) OR die('not conn mysql:'.mysql_connect_error() );
printf("connction success <br>");

echo '我在php代码中连接数据库结束\n';


include 'http://42.96.139.171/db/db_close.php';

?>
</body>
</html>

