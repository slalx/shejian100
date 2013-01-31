
<!doctype html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html;charset=utf8">
    <meta name="viewport" content="width=device-width,user-scalable=no" />
    <link rel="stylesheet" type="text/css" href="/resource/common.css">
    <link rel="stylesheet" type="text/css" href="/resource/css/errortip.css">
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
  <body class="" >
    <div class="container">
      <h3 style="color:green">订餐已经完成，一小时后给您送达</h3>
      <div>来评价下我们的订餐服务吧</div>
      <div id="feedbackform">
        <textarea id="feedbackcontent" class="msg-input" data-message="反馈不能为空且为10-140个字" data-regex="^.{10,140}$"></textarea>
      </div>
      <input type="hidden" value="<?= $restaurantid ?>" id="restaurantid">
      <input type="hidden" value="<?= $fromuser ?>" id="fromuserid">

      <button onclick="submitform();" class="saveorderformbtn">提交反馈</button>
    </div>
    <div class="tips" style="none" id="messagetip"><div class="tipContent err"></div></div>
  </body>
<script type="text/javascript">
  function submitform(){
    if(!ValidateForm.validateForm('feedbackform')){
      return;
    }
    var restaurantid = document.getElementById('restaurantid').value;
    var feedbackcontent = document.getElementById('feedbackcontent').value;
    var fromuserid = document.getElementById('fromuserid').value;
    $.ajax({
      type: "post",
      url: "/t5/savefeedback.php",
      data: { feedbackcontent: feedbackcontent, restaurantid: restaurantid,fromuserid:fromuserid},
      dataType: 'json',
      success:function(data){
        if(data.status==1){
          alert(data.statusText);
        }else{
          alert(data.statusText);
        }
      }
    })
  }

</script>
  <script src="/resource/js/jQuery.js"></script>
  <script src="/resource/js/validateform.js"></script>
</html>





