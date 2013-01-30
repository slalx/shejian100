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
/**
* Location_X 纬度
* Location_Y 经度
*/

 function getStores($page,$Location_X,$Location_Y,$fromUsername) {
    //100000000是为了查询整个表
    $storepage = new Page($page, 3, 1000000000, 'store');
    $storeresult = $storepage->sqlQueryResults();

    $store = new Store('','','','','');
    $storelist = $store->getStoreList($storeresult);

    $storesstr = '';
    $itemTpl = "<item>
      			    <Title><![CDATA[%s          编号:%s]]></Title>
      			    <Description><![CDATA[%s]]></Description>
                 <PicUrl><![CDATA[%s]]></PicUrl>
                <Url><![CDATA[http://42.96.139.171/t5/menulist.php?restaurantid=%s&fromuser=$fromUsername]]></Url>
      			    </item>";
    $j = 0;//记录需要显示给用户的个数          
    for($i = 0; $i < count($storelist); $i++) {
  		$storeobj = $storelist[$i];
      //如果存在经纬度才显示出来
      if($storeobj->lat && $storeobj->lon){
      $distance = distance($Location_X, $Location_Y, $storeobj->lat, $storeobj->lon, "K");
      }
      //如果距离小于3公里，才会显示出来
      if($distance < 3 && $storeobj->lat && $storeobj->lon){
        $picid = $storeobj->id;
        $picurl = "http://42.96.139.171/customer/module/customersetting/upload/$picid.png";
        $storesstr .= sprintf($itemTpl,$storeobj->name,$storeobj->id,$storeobj->address,$picurl,$storeobj->id);
        $j++;
      }
  		
	}

	$storesstr = sprintf("<ArticleCount>%s</ArticleCount>
                             <Articles>%s</Articles>", $j, $storesstr);

    return $storesstr;
 }

/*
  lat 纬度
  lon 经度
  根据纬度和经度算出两点之间的距离
*/
function distance($lat1, $lon1, $lat2, $lon2, $unit) {

  $lat1 = doubleval($lat1);
  $lon1 = doubleval($lon1);
  $lat2 = doubleval($lat2);
  $lon2 = doubleval($lon2);

  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);

  if ($unit == "K") {
    return ($miles * 1.609344);
  } else if ($unit == "N") {
      return ($miles * 0.8684);
  } else {
        return $miles;
  }
}



?>
