
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


  //根据饭店的id查找菜单
  function getMenus($page,$sqlwhere){
      $sqlcondition = '';
      if(substr($sqlwhere, 1, 1) > 0){
        $sqlcondition = "where restaurantid = $sqlwhere";
      }
     $menupage = new Page($page, 100, $sqlcondition, 'dish');
     $menuresult= $menupage->sqlQueryResults();

     $itemTpl = "<li ><span class=\"menucount\">1</span><span class=\"menuname\" onclick=\"liclick();\">%s          </span><span class=\"minus\" onclick=\"minusClick();\">-</span><span class=\"price\">%s</span></li>";
     $count = 0;

      if ($menuresult != false){
        while($menurow = mysql_fetch_array($menuresult)){
          $id = $menurow["id"];
          $name = $menurow["name"];
          $price = $menurow["price"];
          $menusstr .= sprintf($itemTpl, $name, $price);
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
    }
  } 

//打印
//echo $liststr ;

include $_SERVER['DOCUMENT_ROOT'].'/db/db_close.php';
?>
<style type="text/css">
.container{
  background-color: #FFF;
  width: 90.41%;
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
  height: 16px;
  background: red;
  border-radius: 65px;
  padding-left: 11px;
  padding-bottom: 27px;
  visibility: hidden;
}
.menutypeblock li{
    height: 44px;
    line-height: 44px;
    font-size: 22px;
    border-bottom: 1px solid #d3d3d3;
}
.menucount{
  width: 24px;
  height: 30px;
  padding-left: 9px;
  visibility: hidden;
}
.submitbtn{
  float: right;
}
.menuname{
  width: 50%;
}
</style>
  <body class="">
    <div class="container">
      <div class="header">
      <button data-gid="0" class="btnGrayS">0</button>
      <button data-gid="0" class="btnGrayS submitbtn">提交</button>
    </div>
    <div class="storeInfo">
      <div><?= $name ?></div>
      <div><?= $storedesc ?></div>
    </div>
    <?= $liststr ?>
    </div>
  </body>
  <script type="text/javascript">
    function liclick(){
      //console.log('ddd');
      //alert('ddd');
    }
    function minusClick(){
      //console.log('aaa');
      //alert('aaa');
    }
  </script>
</html>





