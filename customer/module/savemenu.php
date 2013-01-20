
<?php

include '../db/db_open.php';

for ($i=0;$i<count($_POST["name"]);$i++){
	if ($_POST["name"][$i]!=''){
		$sql = "insert into dish(name,price,type,restaurantid,userid) values (‘$_POST[dish_name][$i]’,$_POST[dish_price][$i],$_POST[dish_type][$i],10,10)";
		mysql_query($sql);
		echo "插入第".$i."条记录";
	}
}

include '../db/db_close.php';
?>