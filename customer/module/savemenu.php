
<?php
header('Content-Type: text/html; charset=utf-8');

include '../../db/db_open.php';

/*for ($i=0;$i<count($_POST["name"]);$i++){
	echo "插入第".$i."条记录";
	if ($_POST["name"][$i]!=''){
		$sql = "insert into dish(name,price,type,restaurantid,userid) values (‘$_POST[dish_name][$i]’,$_POST[dish_price][$i],$_POST[dish_type][$i],10,10)";
		//mysql_query($sql);
		echo "插入第".$i."条记录";
	}*/
//print_r($_POST['dish']);

/*foreach($_POST['dish'] as $post_key){ 
	print_r($post_key);
	echo $post_key['name']."name的值";
    $query_string .= " ('".$post_key['name']."', '".$post_key['price']."'),"; 
} */

$dishes = $_POST['dish'];

for ($i=0; $i<count($dishes); $i++){
	$row = $dishes[$i];
	print_r($row);
	if ($row != ''){
		$query_string .= " ('".$row['name']."', '".$row['price']."'),"; 
	}
}

//删除最后的逗号
$query_string = substr_replace($query_string,"",-1);
//合成sql语句
$query_string = "insert into dish ('name', 'price') values ".$query_string; 
//插入数据库
echo "插入sql语句*********".$query_string;

include '../../db/db_close.php';
?>