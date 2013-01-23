<?php
include $_SERVER['DOCUMENT_ROOT'].'/publicLib/Store.php';

 $urltype = '';
 $sqltype = '';
  //饭馆名称
  /*if (isset($_GET['address'])){
	//$urltype = '&type='.intval($_GET['type']);
	$sqlcondition = "where address like '%".$_GET['address']."%'";
  }*/
  //设置页数
  $page = 1;
  /*if (isset($_GET['page'])){
	$page = intval($_GET['page']);
  }else{
  //设置为第一页 
    $page = 1;
  }*/
 function getStores($page) {

    $storepage = new Page($page, 3, $sqlcondition, 'store');
    $storeresult = $storepage->sqlQueryResults();

    $store = new Store('','');
    $storelist = $store->getStoreList($storeresult);

    $storesstr = '';
    $itemTpl = "<item><Title><![CDATA[%s]]></Title></item>";

    for($i = 0; $i < count($storelist); $i++) {
  		$storeobj = $storelist[$i];
  		$storesstr .= sprintf($itemTpl,$storeobj->name);
	}
	
    return $storesstr;
 }
?>
