<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,user-scalable=no" />
    <link rel="stylesheet" type="text/css" href="/resource/common.css">
    <link rel="stylesheet" type="text/css" href="/resource/css/errortip.css">
    <title>提交订单</title> 
  </head>
  <?php
include $_SERVER['DOCUMENT_ROOT'].'/db/db_open.php';

  //饭馆id
  $restaurantid = -1;
  if (isset($_GET['restaurantid'])){
    $restaurantid = $_GET['restaurantid'];
  }

  $ordercount = '*';
    if (isset($_GET['ordercount'])){
    $ordercount = $_GET['ordercount'];
    $ordercount = substr_replace($ordercount,"",-1);
  }
  
  $fromuser = '';
  if (isset($_GET['fromuser'])){
    $fromuser = $_GET['fromuser'];
  } 

  $mobiletelephone = '';
  if (isset($_GET['mobiletelephone'])){
    $mobiletelephone = $_GET['mobiletelephone'];
  } 

  $storestatus = $_GET['storestatus'];

  //totalcount
  $totalcount =0;
  $totalprice=0;
  //查找菜单信息
  $listTpl = "<li><span>%s</span><span class=\"right\">%s份</span></li>";
  if($ordercount){
     $orderarr = explode("*",$ordercount);
     //
     //var_dump($orderarr);
     for($i=0; $i <count($orderarr); $i++){
        $order = $orderarr[$i];//
        $orderobj = explode(":",$order);
        $menuid = $orderobj[0];//菜的id
        $menucount = $orderobj[1];//定的数量

        $totalcount = $totalcount+$menucount;
        $typeresult = mysql_query("select * from dish where restaurantid=$restaurantid and id=$menuid;");
        if ($typeresult != false){
          while($row = mysql_fetch_array($typeresult)){
            $name = $row["name"];
            $menuprice = intval($row["price"]);
            $totalprice = $menuprice*intval($menucount) + $totalprice;
            $liststr.= sprintf($listTpl, $name,$menucount);     

          }
        }
     }   
  }

//查找用户的信息
$userresult = mysql_query("select * from orderform where userid='$fromuser' order by id desc;");
if ($userresult != false){
    $row = mysql_fetch_array($userresult);
    $address = $row["address"];
    $telephone = $row["telephone"];
    $chusername = $row["chusername"];
    //$liststr.= sprintf($listTpl, $name);       
}
 

include $_SERVER['DOCUMENT_ROOT'].'/db/db_close.php';
?>
<style type="text/css">
  .container{
    margin: 0 10px;
    width: 94%;
  }
  ul{
    background: white;
    -moz-border-radius: 5px;   /* 圆的半径为边长的一半，即300px */
    -webkit-border-radius: 5px;
    border-radius: 5px; 
  }
  h3{
    margin: 10px 0;
  }
  ul li{
    border-bottom: 1px dotted #785;
    height: 45px;
    line-height: 45px;
    font-size: 13px;
    padding-left: 14px;
    padding-right: 14px;
  }
  .orderInfo .firstli{
    border-bottom: 1px solid black;
  }
  .userinfo input{
    width:70%;
    margin-left: 10px;
  }
  li:last-child{
    border-bottom:none;
  }
.saveorderformbtn{
    width: 100%;
    margin-top: 10px;
    height: 45px;
    margin-bottom: 10px;
}
</style>
  <body class="">
    <div class="container">
      <h3>订单信息</h3>
      <ul class="orderInfo">
        <li class="firstli">合计：<?= $totalcount ?>份<span class="right">￥<?= $totalprice?></span></li>
        <?= $liststr ?>
      </ul>
      <?php echo "$storestatus"; if($storestatus == '1'){?>
      <h3>送餐地址</h3>
      <ul class="userinfo" id="userinfoform">
        <li><span>地址</span><input class="msg-input" type="text" value="<?= $address ?>" id="addressid" data-message="地址不能为空且长度不能超过100字" data-regex="^[\u4e00-\u9fa50-9a-zA-Z]{1,100}$"></li>
        <li><span>电话</span><input class="msg-input" type="text" value="<?= $telephone ?>" id="telephoneid" data-message="手机号不能为空且为11位数字" data-regex="^[0-9]{11,11}$"></li>
        <li><span>姓名</span><input class="msg-input" type="text" value="<?= $chusername ?>" id="chusernameid" data-message="姓名不能为空且长度不能超过20字" data-regex="^[\u4e00-\u9fa5]{1,20}$"></li>
      </ul>
      <input type="hidden" value="<?= $restaurantid ?>" id="restaurantid">
      <input type="hidden" value="<?= $ordercount ?>" id="ordercountid">
      <input type="hidden" value="<?= $fromuser ?>" id="fromuserid">
      <input type="hidden" value="<?= $mobiletelephone ?>" id="mobiletelephone">
       <button onclick="submitform();" class="saveorderformbtn">确认下单</button>
      <?php }else if ($storestatus == '0') { ?>
        <a href="tel:<?= $mobiletelephone ?>" class="saveorderformbtn">电话下单</a>
      
     <?php }?>
    </div>
    <div class="tips" style="none" id="messagetip"><div class="tipContent err"></div></div>
  </body>
<script type="text/javascript">
  function submitform(){
    if(!ValidateForm.validateForm('userinfoform')){
      return;
    }
    var restaurantid = document.getElementById('restaurantid').value;
    var ordercountid = document.getElementById('ordercountid').value;
    var fromuserid = document.getElementById('fromuserid').value;
    var addressid = document.getElementById('addressid').value;
    var telephoneid = document.getElementById('telephoneid').value;
    var chusername = document.getElementById('chusernameid').value;
    var mobiletelephone = document.getElementById('mobiletelephone').value;

    $.ajax({
      type: "post",
      url: "/t5/saveorderform.php",
      data: { ordercountid: ordercountid, restaurantid: restaurantid,fromuserid:fromuserid,addressid:addressid,telephoneid:telephoneid,chusername:chusername,mobiletelephone:mobiletelephone},
      dataType: 'json',
      success:function(data){
        if(data.status==1){
          alert(data.statusText);
          window.location.href="/t5/feedback.php?restaurantid="+restaurantid+"&fromuserid="+fromuserid;
        }else{
          alert(data.statusText);
        }
      }
    })
  }

</script>
<?php 
include_once $_SERVER['DOCUMENT_ROOT'].'/customer/include/jsinclude.php';
?>
</html>





