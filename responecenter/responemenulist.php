<?php
include $_SERVER['DOCUMENT_ROOT'].'/publicLib/Menu.php';

  //根据饭店的id查找菜单
  function getMenus($page,$keyword,$fromUsername){

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

      $sqlcondition = "where coverimage=1 and name like '%$keyword%'";
      $storepage = new Page($page, 10, $sqlcondition, 'store');
      $storeresult = $storepage->sqlQueryResults();

      $store = new Store('','','','','');
      $storelist = $store->getStoreList($storeresult);

      $storesstr = '';
      $itemTpl = "<item>
                    <Title><![CDATA[%s]]></Title>
                    <Description><![CDATA[%s]]></Description>
                    <PicUrl><![CDATA[%s]]></PicUrl>
                    <Url><![CDATA[http://42.96.139.171/t5/menulist.php?restaurantid=%s&fromuser=$fromUsername]]></Url>
                    </item>";
      $j = 0;//记录需要显示给用户的个数          
      for($i = 0; $i < count($storelist); $i++) {
          $storeobj = $storelist[$i];
          //列出前
          $picid = $storeobj->id;
          $picurl = "http://42.96.139.171/customer/module/customersetting/upload/$picid.png";
          $storesstr .= sprintf($itemTpl,$storeobj->name,$storeobj->address,$picurl,$storeobj->id); 
          $j++; 
      }
      if(!$storesstr){
        //这种情况默认为是第一次关注的时候
        if($keyword=='Hello2BizUser'){
          $storesstr = "谢谢您成为舌尖网会员，您可以1.发送地理位置来搜索您周边边的餐馆;2.输入您要查找的餐馆名称。等搜出结果以后，点击餐馆就可以订餐了!!!@";
        }else{//已输入文字，就认为是输入的餐馆的名称进行查找
          $storesstr = "你要找的餐馆目前还没有入驻，我们会尽快帮您联系@";
        }
      }else{
        $storesstr = sprintf("<ArticleCount>%s</ArticleCount>
                                 <Articles>%s</Articles>", $j, $storesstr);      
      }
   

	   return $storesstr; 	
  }

  


?>

