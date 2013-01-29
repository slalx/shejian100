
<!doctype html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html;charset=utf8">
    <meta name="viewport" content="width=device-width,user-scalable=no" />
    <link rel="stylesheet" type="text/css" href="/resource/common.css">
    <title>提交订单</title> 
  </head>
  <?php

  //饭馆id
  $restaurantid = -1;
  if (isset($_GET['restaurantid'])){
    $restaurantid = $_GET['restaurantid'];
  }

  $fromuser = '';
  if (isset($_GET['fromuser'])){
    $fromuser = $_GET['fromuser'];
  } 

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

.saveorderformbtn{
    width: 100%;
    margin-top: 10px;
    height: 45px;
    margin-bottom: 10px;
}
#feedbackcontent{
  margin-top: 10px;
  width: 100%;
  height: 140px;
  border:none;
}
</style>
  <body class="">
    <div class="container">
      <h3 style="color:green">订餐已经完成，一小时后给您送达</h3>
      <div>来评价下我们的订餐服务吧</div>
      <div>
        <textarea id="feedbackcontent"></textarea>
      </div>
      <input type="hidden" value="<?= $restaurantid ?>" id="restaurantid">
      <input type="hidden" value="<?= $fromuser ?>" id="fromuserid">

      <button onclick="submitform();" class="saveorderformbtn">确认下单</button>
    </div>
  </body>
<script type="text/javascript">
  function submitform(){
    var restaurantid = document.getElementById('restaurantid').value;
    var feedbackcontent = document.getElementById('feedbackcontent').value;
    var fromuserid = document.getElementById('fromuserid').value;
    $.ajax({
      type: "post",
      url: "/t5/savefeedback.php",
      data: { feedbackcontent: feedbackcontent, restaurantid: restaurantid,fromuserid:fromuserid},
      dataType: 'json',
      success:function(data){
        alert(data.statusText);
      }
    })
  }

</script>
  <script src="/resource/js/jQuery.js"></script>
</html>





