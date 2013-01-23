<?php
include $_SERVER['DOCUMENT_ROOT'].'/publicLib/Menu.php';

 $urltype = '';
 $sqltype = '';
  //饭馆名称
  /*if (isset($_GET['restaurantid'])){
	//$urltype = '&type='.intval($_GET['type']);
	$sqlcondition = "where restaurantid=".$_GET['restaurantid'];
  }*/
  //设置页数
  $page = 1;
  /*if (isset($_GET['page'])){
	$page = intval($_GET['page']);
  }else{
  //设置为第一页 
    $page = 1;
  }*/

  function getMenus($page){

	   $menupage = new Page($page, 3, $sqlcondition, 'dish');
	   $menuresult= $menupage->sqlQueryResults();

	   $itemTpl = "<item><Title><![CDATA[%s]]></Title></item>";

      if ($menuresult != false){
        while($menurow = mysql_fetch_array($menuresult)){
  			$name = $menurow["name"];
  			$price = $menurow["price"];
        	$menusstr .= sprintf($itemTpl,$name);
        }
      }

	   return $menusstr; 	
  }
?>

