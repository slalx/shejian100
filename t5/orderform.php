
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
  $listTpl = "<li>%s</li>";
  if($ordercount){
     $orderarr = explode("*",$ordercount);
     for($i=0; $i <count($orderarr); $i++){
        $order = $orderarr[$i];
        $menuid = explode(":",$order);
        $menuid = $menuid[0];
        $typeresult = mysql_query("select * from dish where restaurantid=$restaurantid and id=$menuid;");
        if ($typeresult != false){
          while($row = mysql_fetch_array($typeresult)){
            $name = $row["name"];
            $liststr.= sprintf($listTpl, $name);     

          }
        }
     }   
  }

//查找用户的信息
        $userresult = mysql_query("select * from usersinfo where username='$fromuser';");
        if ($userresult != false){
            $row = mysql_fetch_array($userresult);
            $address = $row["address"];
            $telephone = $row["telephone"];
            //$liststr.= sprintf($listTpl, $name);       
        }
 

//打印
//echo $liststr ;

include $_SERVER['DOCUMENT_ROOT'].'/db/db_close.php';
?>
  <body class="">
    <ul><?= $liststr ?></ul>
    <input type="hidden" value="<?= $restaurantid ?>" id="restaurantid">
    <input type="hidden" value="<?= $ordercount ?>" id="ordercountid">
    <input type="hidden" value="<?= $fromuser ?>" id="fromuserid">
    <input type="text" value="<?= $address ?>" id="addressid">
    <input type="text" value="<?= $telephone ?>" id="telephoneid">
<button onclick="submitform();">提交</button>
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
      }
    })
  }

</script>
  <script src="/resource/js/jQuery.js"></script>
</html>





