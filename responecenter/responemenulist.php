<?php
include $_SERVER['DOCUMENT_ROOT'].'/publicLib/Menu.php';

  //根据饭店的id查找菜单
  function getMenus($page,$keyword){

     /*$sqlcondition = "where restaurantid = $keyword";
	   $menupage = new Page($page, 10, $sqlcondition, 'dish');
	   $menuresult= $menupage->sqlQueryResults();

	   $itemTpl = "<item><Title><![CDATA[%s  %s             %s]]></Title></item>";
     $count = 0;
      if ($menuresult != false){
        while($menurow = mysql_fetch_array($menuresult)){
        	$id = $menurow["id"];
  			  $name = $menurow["name"];
  			  $price = $menurow["price"];
        	$menusstr .= sprintf($itemTpl, $id, $name, $price);
          $count ++;
        }
      }
      $menusstr = sprintf("<ArticleCount>%s</ArticleCount>
                             <Articles>%s</Articles>",$count,$menusstr);*/

      $sqlcondition = "where name like '%$keyword%'";
      $storepage = new Page($page, 10, $sqlcondition, 'store');
      $storeresult = $storepage->sqlQueryResults();

      $store = new Store('','','','','');
      $storelist = $store->getStoreList($storeresult);

      $storesstr = '';
      $itemTpl = "<item>
                    <Title><![CDATA[%s          编号:%s]]></Title>
                    <Description><![CDATA[%s]]></Description>
                    <Url><![CDATA[http://42.96.139.171/t5/menulist.php?restaurantid=%s&fromuser=$fromUsername]]></Url>
                    </item>";
      $j = 0;//记录需要显示给用户的个数          
      for($i = 0; $i < count($storelist); $i++) {
          $storeobj = $storelist[$i];
          //列出前
          $storesstr .= sprintf($itemTpl,$storeobj->name,$storeobj->id,$storeobj->address,$storeobj->id);  
      }
      if(!$storesstr){
        $storesstr = "你要找的餐馆目前还没有入驻，我们会尽快帮您联系!";
      }else{
        $storesstr = sprintf("<ArticleCount>%s</ArticleCount>
                                 <Articles>%s</Articles>", $j, $storesstr);      
      }
   

	   return $storesstr; 	
  }

  


?>

