<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,user-scalable=no" />
    <link rel="stylesheet" type="text/css" href="/resource/common.css">
    <title>商户合作平台登录</title> 
  </head>
  <?php
include_once $_SERVER['DOCUMENT_ROOT'].'/db/db_open.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/publicLib/Menu.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/publicLib/page.php';
date_default_timezone_set("Asia/Chongqing");
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

  $fromuser = 'noname';
    if (isset($_GET['fromuser'])){
    $fromuser = $_GET['fromuser'];
  }

  //根据饭店的id查找菜单
  function getMenus($page,$sqlwhere){
      $sqlcondition = '';
      if(substr($sqlwhere, 1, 1) > 0){
        $sqlcondition = "where restaurantid = $sqlwhere";
      }
     $menupage = new Page($page, 100, $sqlcondition, 'dish');
     $menuresult= $menupage->sqlQueryResults();

     $itemTpl = "<li ><span class=\"menucount\" id=\"countel_%s\">0</span><span class=\"menuname\" onclick=\"liclick(%s);\">%s          </span><span class=\"minus\" id=\"minus_%s\" onclick=\"minusClick(%s);\">-</span><span class=\"price\">%s元</span></li>";
     $count = 0;

      if ($menuresult != false){
        while($menurow = mysql_fetch_array($menuresult)){
          $id = $menurow["id"];
          $name = $menurow["name"];
          $price = intval($menurow["price"]);
          $menusstr .= sprintf($itemTpl, $id, $id, $name, $id, $id, $price);
          //$count ++;
        }
      }
      if ($menusstr) {
        $menusstr = sprintf("<ul>%s</ul>",$menusstr);
      }
     
     return $menusstr;  
  }

  //查找菜单的类别
  $typeresult = mysql_query("select * from menutype where restaurantid=$restaurantid;");
  $listTpl = "<div class=\"menutypeblock\"><h1 class=\"typenavigation\">%s</h1>%s</div>";
  if ($typeresult != false){
    while($row = mysql_fetch_array($typeresult)){
      $id = $row["id"];
      $name = $row["name"];
      $sqlcondtions = "'$restaurantid' and type=$id";
      $menulist=getMenus($page,$sqlcondtions);
      if($menulist){
        $liststr.= sprintf($listTpl, $name,$menulist);     
      }
    }
  }

  //查找店的详细信息
  $storeresult = mysql_query("select * from store where id=$restaurantid;");
   if ($storeresult != false){
    while($row = mysql_fetch_array($storeresult)){
      $id = $row["id"];
      $name = $row["name"];
      $storedesc = $row["storedesc"];
      $address = $row["address"];
      $telephone = $row["telephone"];
      $mobiletelephone = $row["mobilephone"];
      $starttime = $row["starttime"];
      $endtime = $row["endtime"];
      $storetype = $row["storetype"];
      $storestatus = $row["storestatus"];
    }
  } 
$nowdate = getdate();
$nowhour = $nowdate["hours"];
$isfinish = 1;
if($nowhour > $endtime || $nowhour < $starttime){
  $isfinish = 2;
}
//打印
//echo $liststr ;

include $_SERVER['DOCUMENT_ROOT'].'/db/db_close.php';
?>
<style type="text/css">
.container{
  background-color: #FFF;
  width: 100%;
}
h3 {
  padding-left: 10px;
}
.menutypeblock .typenavigation{
    height: 36px;
    background-color: #5ba607;
    background-image: linear-gradient(bottom,#4d910c 3%,#69b310 97%,#fff 100%);
    background-image: -moz-linear-gradient(bottom,#4d910c 3%,#69b310 97%,#fff 100%);
    background-image: -webkit-linear-gradient(bottom,#4d910c 3%,#69b310 97%,#fff 100%);
}
.menutypeblock span{
  display: inline-block;
}
.price,.minus{
    float: right;
}
.minus{
  font-size: 36px;
  width: 24px;
  height: 32px;
  background: red;
  border-radius: 3px;
  visibility: hidden;
  margin-top: 5px;
  margin-bottom: 5px;
  text-align: center;
  color: white;
  line-height: 32px;
  margin-right: 5px;
}
.menutypeblock li{
    height: 44px;
    line-height: 44px;
    font-size: 15px;
    border-bottom: 1px solid #d3d3d3;
    color: #484848;
}
.menucount{
  width: 24px;
  height: 30px;
  visibility: hidden;
  text-align: center;
  color: 
  #fff;
  background: 
  #5ba607;
  line-height: 30px;
  border-radius: 3px;
  margin: 0 3px;
}
.submitbtn{
 margin-right: 10px;
}
.menuname{
  width: 70%;
}
.storeInfo{
  color: #8c8c8c;
}
.storeInfo span{
  margin-left: 10px;
}
.storename{
  padding-top: 10px;
  font-size: 22px;
  color: black;
}
.storedesc{
  padding-top: 10px;
  padding-bottom: 10px;
}
.storeInfo .address{
  padding-right: 10px;
}
#hasorder{
  padding-top: 3px;
  padding-right: 10px;
  height: 33px;
  width: 100%;
  position: fixed;
  background: #f1f1f1;
  border: 1px solid #d3d3d3;
}
.totalcount{
  background: red;
  color: white;
  font-size: 25px;
  -webkit-border-radius:3px;
  -moz-border-radius:3px;
  border-radius: 3px;
  display: inline-block;
  width: 30px;
  height: 30px;
  vertical-align: middle;
  text-align: center;
  line-height: 30px;
}
.price{
  margin-right: 5px;
}
.storeaddress{
  padding-left: 10px;
  width: 69%;
}
</style>
  <body class="">
    <div class="container">
      <div class="storeInfo">
        <div style="position:fixed;opacity:0;" id="hasorder"><span class="totalcount">0</span><span class="right"><button data-gid="0" class="btnGrayS submitbtn" onclick="submitorder();">下一步</button></span></div>
        <div class="storename"><span><?= $name ?></span></div>
        <div class="storeaddress">地址：<?= $address ?></div>
        <div class="storedesc"><span style="display: inline-block; width: 69%;"><?= $storedesc ?></span><span class="address right"><?php if($isfinish==1){ ?><a class="btnGrayS" href="tel:<?= $mobiletelephone ?>">拨打电话</a><?php } else{echo "已打烊"; }?></span></div>
      </div>
      <div id="menulistcontent">
        <?= $liststr ?>
      </div>
    </div>
  </body>
  <script type="text/javascript">
    function liclick(id){
      //var isfinish = ;
      if(<?= $isfinish?>==2){
        return;
      }
      var countobj = document.getElementById('countel_'+id);
      var minusobj = document.getElementById('minus_'+id);
      var hasorder = document.getElementById('hasorder');
      var spancount = hasorder.firstElementChild;
        countobj.style.visibility = 'visible';
        countobj.innerHTML = parseInt(countobj.innerHTML)+1;
        spancount.innerHTML = parseInt(spancount.innerHTML)+1;
        minusobj.style.visibility = 'visible';
        hasorder.style.opacity = 1;
    }
    function minusClick(id){
      var countobj = document.getElementById('countel_'+id);
      var minusobj = document.getElementById('minus_'+id);
      var hasorder = document.getElementById('hasorder');
      var currentcount = countobj.innerHTML;
      var nowcount = parseInt(currentcount)-1;
      var totalnowcount = parseInt(hasorder.firstElementChild.innerHTML)-1;
      if(totalnowcount > 0){
        hasorder.firstElementChild.innerHTML = totalnowcount;
      }else{
        hasorder.style.opacity = 0;
        hasorder.firstElementChild.innerHTML  = 0;
      }
      if(nowcount>0){
        countobj.innerHTML = nowcount;
      }else{
        countobj.innerHTML = nowcount;
        countobj.style.visibility = 'hidden';
        minusobj.style.visibility = 'hidden';
       // hasorder.style.opacity = 0;
      }
    }

    function submitorder(){
      var menucontent = document.getElementById('menulistcontent');
      var lis = document.getElementsByTagName('li');
      var orderstr='';
      for(var i=0,l=lis.length; i<l; i++){
        var countobj = lis[i];
        var mid = countobj.firstElementChild.getAttribute('id').substr(8);
        var mcount = countobj.firstElementChild.innerHTML;
        if(parseInt(mcount)>0){
          orderstr=orderstr+mid+':'+mcount+'*'
        }
      }
      
      window.location.href = '/t5/orderform.php?restaurantid='+'<?= $restaurantid?>'+'&ordercount='+orderstr+"&fromuser="+'<?= $fromuser?>'+"&mobiletelephone="+'<?= $mobiletelephone?>'+"&storestatus="+'<?= $storestatus?>';
    }

    /*window.document.onscroll = function(){
      setTimeout(function(){      
            var db= document.body;
            var hasorder = document.getElementById('hasorder');
            var doffsettop = parseInt(db.scrollTop);
            console.log(doffsettop);
            if(doffsettop > 0){
                hasorder.style.position="fixed";
            }else{
              hasorder.style.position="static";
            }
    },0);
    }*/
  </script>
</html>





