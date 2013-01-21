
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

foreach($_POST['dish'] as $post_key){ 
    $query_string .= " ('".$post_key['name']."', '".$post_key['price']."'),"; 
    print_r($post_key);
} 
//$query_string = substr_replace($query_string,"",-1);
$query_string = "insert into dish ('name', 'price') values ".$query_string; 

echo "插入sql语句".$query_string;

include '../../db/db_close.php';
?>