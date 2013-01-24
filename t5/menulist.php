<?php
header('Content-Type: text/html; charset=utf-8');
include $_SERVER['DOCUMENT_ROOT'].'/db/db_open.php';
include $_SERVER['DOCUMENT_ROOT'].'/publicLib/Menu.php';
include $_SERVER['DOCUMENT_ROOT'].'/publicLib/page.php';

  //饭馆名称
  $restaurantid = -1;
  if (isset($_GET['restaurantid'])){
    $restaurantid = $_GET['restaurantid'];
  }
  //设置页数
  $page = 1;
  if (isset($_GET['page'])){
    $page = intval($_GET['page']);
  }


  //根据饭店的id查找菜单
  function getMenus($page,$restaurantid){
      $sqlcondition = '';
      if($restaurantid > 0){
        $sqlcondition = "where restaurantid = '$restaurantid'";
      }
	   $menupage = new Page($page, 3, $sqlcondition, 'dish');
	   $menuresult= $menupage->sqlQueryResults();

	   $itemTpl = "<li>菜名：%s     价格：%s  编号：%s</li>";
     $count = 0;

      if ($menuresult != false){
        while($menurow = mysql_fetch_array($menuresult)){
        	$id = $menurow["id"];
  			  $name = $menurow["name"];
  			  $price = $menurow["price"];
        	$menusstr .= sprintf($itemTpl, $name, $price, $id);
          //$count ++;
        }
      }
      $menusstr = sprintf("<ul>%s</ul>",$menusstr);
     
	   return $menusstr; 	
  }

echo getMenus(1,$restaurantid);
include $_SERVER['DOCUMENT_ROOT'].'/db/db_close.php';
?>

