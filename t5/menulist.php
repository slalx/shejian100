
<!doctype html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html;charset=utf8">
    <meta name="viewport" content="width=device-width,user-scalable=no" />
    <link rel="stylesheet" type="text/css" href="/resource/common.css">
    <title>商户合作平台登录</title> 
  </head>
  <?php
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
    }
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
  color: #ff9800;
}
.submitbtn{

}
.menuname{
  width: 50%;
}
.storeInfo{
  color: #8c8c8c;
}
.storeInfo span{
  margin-left: 10px;
}
.storeaddandname{
  padding-top: 10px;
}
.storedesc{
  padding-top: 10px;
  padding-bottom: 10px;
}
.storeInfo .address{
  padding-right: 10px;
}
#hasorder{
  padding-top: 10px;
  padding-right: 10px;
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
</style>
  <body class="">
    <div class="container">
      <div class="storeInfo">
        <div style="display:none;" id="hasorder"><span class="totalcount">0</span><span class="right"><button data-gid="0" class="btnGrayS submitbtn" onclick="submitorder();">下一步</button></span></div>
        <div class="storeaddandname"><span><?= $name ?></span><span class="address right">地址：<?= $address ?></span></div>
        <div class="storedesc"><span><?= $storedesc ?></span></div>
      </div>
      <div id="menulistcontent">
        <?= $liststr ?>
      </div>
    </div>
  </body>
  <script type="text/javascript">
    function liclick(id){
      var countobj = document.getElementById('countel_'+id);
      var minusobj = document.getElementById('minus_'+id);
      var hasorder = document.getElementById('hasorder');
      var spancount = hasorder.firstElementChild;
        countobj.style.visibility = 'visible';
        countobj.innerHTML = parseInt(countobj.innerHTML)+1;
        spancount.innerHTML = parseInt(spancount.innerHTML)+1;
        minusobj.style.visibility = 'visible';
        hasorder.style.display = '';
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
        hasorder.style.display = 'none';
        hasorder.firstElementChild.innerHTML  = 0;
      }
      if(nowcount>0){
        countobj.innerHTML = nowcount;
      }else{
        countobj.innerHTML = nowcount;
        countobj.style.visibility = 'hidden';
        minusobj.style.visibility = 'hidden';
        //hasorder.style.display = 'none';
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
      
      window.location.href = '/t5/orderform.php?restaurantid='+'<?= $restaurantid?>'+'&ordercount='+orderstr+"&fromuser="+'<?= $fromuser?>';
    }
  </script>
</html>





