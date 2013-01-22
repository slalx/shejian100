<?php 


DEFINE('DB_HOST','localhost');
DEFINE('DB_USER','root');
DEFINE('DB_PASSWORD','');
DEFINE('DB_NAME','shejian100');


$con = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
if (!$con){
  die('Could not connect: ' . mysql_error());
}
mysql_select_db(DB_NAME, $con);
mysql_query("SET NAMES utf8"); //防止数据库乱码

?>

