
<!doctype html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html;charset=utf8">
    <meta name="viewport" content="width=device-width,user-scalable=no" />
    <link rel="stylesheet" type="text/css" href="/resource/common.css">
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



  //查找菜单信息
  $listTpl = "<li><span>%s</span><span class=\"right\">%s份</span></li>";
  if($ordercount){
     $orderarr = explode("*",$ordercount);
     for($i=0; $i <count($orderarr); $i++){
        $order = $orderarr[$i];
        $menuid = explode(":",$order);
        $menuid = $menuid[0];
        $menucount = $menuid[1];
        $typeresult = mysql_query("select * from dish where restaurantid=$restaurantid and id=$menuid;");
        if ($typeresult != false){
          while($row = mysql_fetch_array($typeresult)){
            $name = $row["name"];
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
        <li class="firstli">合计：4份<span class="right">￥50</span></li>
        <?= $liststr ?>
      </ul>
      <h3>送餐地址</h3>
      <ul class="userinfo">
        <li><span>地址</span><input type="text" value="<?= $address ?>" id="addressid"></li>
        <li><span>电话</span><input type="text" value="<?= $telephone ?>" id="telephoneid"></li>
      </ul>
      <input type="hidden" value="<?= $restaurantid ?>" id="restaurantid">
      <input type="hidden" value="<?= $ordercount ?>" id="ordercountid">
      <input type="hidden" value="<?= $fromuser ?>" id="fromuserid">

      <button onclick="submitform();" class="saveorderformbtn">确认下单</button>
    </div>
  </body>
<script type="text/javascript">
  function submitform(){
    var restaurantid = document.getElementById('restaurantid').value;
    var ordercountid = document.getElementById('ordercountid').value;
    var fromuserid = document.getElementById('fromuserid').value;
    var addressid = document.getElementById('addressid').value;
    var telephoneid = document.getElementById('telephoneid').value;
    $.ajax({
      type: "post",
      url: "/t5/saveorderform.php",
      data: { ordercountid: ordercountid, restaurantid: restaurantid,fromuserid:fromuserid,addressid:addressid,telephoneid:telephoneid},
      dataType: 'json',
      success:function(data){
        alert(data.statusText);
        window.location.href="/t5/feedback.php?feedbackcontent="+restaurantid+"&fromuserid="+fromuserid;
      }
    })
  }

</script>
  <script src="/resource/js/jQuery.js"></script>
</html>





