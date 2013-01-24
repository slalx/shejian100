<?php
include $_SERVER['DOCUMENT_ROOT'].'/publicLib/Menu.php';

  //根据饭店的id查找菜单
  function getMenus($page,$keyword){
	   $menupage = new Page($page, 3, $sqlcondition, 'dish');
	   $menuresult= $menupage->sqlQueryResults();

	   $itemTpl = "<item><Title><![CDATA[%s  %s             %s]]></Title></item>";

      if ($menuresult != false){
        while($menurow = mysql_fetch_array($menuresult)){
        	$id = $menurow["id"];
  			  $name = $menurow["name"];
  			  $price = $menurow["price"];
        	$menusstr .= sprintf($itemTpl, $id, $name, $price);
        }
      }
      $menusstr = sprintf("<ArticleCount>3</ArticleCount>
                             <Articles>%s</Articles>",$menusstr);
	   return $menusstr; 	
  }



?>

