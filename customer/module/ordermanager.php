
<?php

include $_SERVER['DOCUMENT_ROOT'].'/db/db_open.php';
include $_SERVER['DOCUMENT_ROOT'].'/publicLib/Order.php';

 $urltype = '';
 $sqltype = '';
 $restaurantid = $_COOKIE["sj_uid"];
  //请求条件
  if (isset($_GET['status'])){
	$urltype = '&status='.intval($_GET['status']);
	$sqltype = " and status=".$_GET['status'];
  }

  $sqltype = "where restaurantid='$restaurantid'".$sqltype;


  //现在是第几页
  if (isset($_GET['page'])){
	$page = intval($_GET['page']);
  }else{
  //设置为第一页 
    $page = 1;
  }

  $orderobj = new Order('','','','','','');

//取得记录总数$rs,计算总页数用
  $pages = $orderobj->getTotalOrdersCount($page,10,$sqltype);


//读取指定记录数

  $result = $orderobj->getOrdersByDate($page,10,$sqltype);

  //计算上一页，下一页
  $first=1;
  $prev=$page-1;
  $next=$page+1;
  $last=$pages;

  $prevpageurl = '/customer/home.php?module=ordermanager&page='.$prev.$urltype;
  $nextpageurl = '/customer/home.php?module=ordermanager&page='.$next.$urltype;
  
  $prevclass = '';
  $nextclass = '';

  if($pages == 1  || $pages == 0){
   	$prevpageurl='javascript:void(0);';
  	$nextpageurl='javascript:void(0)'; 	
  	$prevclass = 'textDisable';
  	$nextclass = 'textDisable';
  }else{
  	if ($page == 1) {
  		$prevpageurl='javascript:void(0);';
  		$prevclass = 'textDisable';
  	}elseif ($page == $pages) {
  		$nextpageurl='javascript:void(0)'; 	
  		$nextclass = 'textDisable';
  	}
  }

  if($pages == 0){
  	$page = 0;
  }


  function getorderliststr($ordercount){
    $listTpl = "<li><span>%s</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=\"right\">%s份</span></li>";
	  if($ordercount){
	     $orderarr = explode("*",$ordercount);
	     $restaurantid = $_COOKIE["sj_uid"];
	     for($i=0; $i <count($orderarr); $i++){
	        $order = $orderarr[$i];
	        $menuidandcount = explode(":",$order);
	        $menuid = $menuidandcount[0];
	        $menucount = $menuidandcount[1];
	        $typeresult = mysql_query("select * from dish where restaurantid=$restaurantid and id=$menuid;");
	        if ($typeresult != false){
	          while($row = mysql_fetch_array($typeresult)){
	            $name = $row["name"];
	            $liststr.= sprintf($listTpl, $name,$menucount);     

	          }
	        }
	     } 
	     return   $liststr;
	  }
  }

?>

<style type="text/css">
.time,.msg,.opt{
 text-align: center;
 width: 125px;
}
.iconDelete{
	background-position: 0 -195px;
}
.vh{
	visibility: visible;
}
.wxMsg ul{
	margin-top: 10px;
	border: 1px solid #f1f1f1;
	background-color: #fff;
	border-radius: 3px;
}
.wxMsg ul li{
	color: #4d5d2c;
	font-size: 16px;
	border-bottom: 1px dotted #f1f1f1;
	padding: 0 10px;
}
.msgSender{
	width: 50px;
	text-align: center;
}
.msgSender img{
	margin-bottom: 10px;
}
</style>

<div id="main" class="container">
	<div class="containerBox"> 
		<div class="boxHeader"> 
			<h2>订单管理</h2> 
		</div> 
		<div class="content"> 
			<div class="cLine"> 
				<div class="pageNavigator right"> 
					<span> <a href="<?= $prevpageurl ?>" class="<?= $prevclass ?>"> 上一页</a> </span> 
					<span class="pageNum">&nbsp;&nbsp;<?= $page ?>&nbsp;/&nbsp;<?= $pages ?>&nbsp;&nbsp;</span> 
					<span> <a href="<?= $nextpageurl ?>" class="<?= $nextclass ?>"> 下一页</a> </span> 
				</div> 
			</div> 
		<div class="listTitle"> 
			<div class="left title msg">订单</div> 
			<div class="right title opt">操作</div> 
			<div class="right title time">时间</div> 
		</div> 
		<ul id="listContainer">
			<?php
				if ($result != false){
					$i=0;
					while($row = mysql_fetch_array($result)){
						$i++;
						$id = $row["id"];
						$userid=$row["userid"];//
						$chusername=$row["chusername"];//
						$address=$row["address"];
						$telephone = $row["telephone"];
						$createtime = $row["createtime"];
						$orderform = $row["orderinfo"];
						$statusorder = $row["status"];
						$ordermenuliststr = getorderliststr($orderform);

						//状态的判断
						if($statusorder == 1){
							$statusordertext =  "未送餐";
							$fontcolor = 'black';
							$styledisplay = '';
							$deleteDisplay = '';
						}elseif ($statusorder==3) {
							$statusordertext =  "已删除";
							$fontcolor = 'red';
							$styledisplay = 'none';
							$deleteDisplay = 'none';
						}elseif ($statusorder==2) {
							$statusordertext = "已送餐";
							$fontcolor = 'green';
							$styledisplay = 'none';
							$deleteDisplay = '';
						}
			?>  
			<li class="msgListItem buddyRichInfoC " id="orderListItem<?= $id ?>" data-id="<?= $id ?>"> 
				<a target="_blank" href="javascript:;" class="msgSender left" style="color:<?= $fontcolor ?>"> 
					<img height="48" width="48" src="http://res.wx.qq.com/mpres/htmledition/images/favicon125122.ico" data-fakeid="13073955" class="avatar left">
					<?= $statusordertext ?>
				</a> 
				<div class="wxMsgArea"> 
					<div class="opt oper right"> 
						<a href="javascript:;" onclick="sendDish(2,<?= $id ?>);" class="icon18 iconEdit" data-fakeid="13073955" title="送餐" style="display:<?=$styledisplay?>"></a>  
						<a href="javascript:;" onclick="sendDish(3,<?= $id ?>);" class="icon18 iconDelete" target="_blank" idx="9472736" title="删除" style="display:<?=$deleteDisplay?>"></a> 
						<a href="javascript:;" onclick="sendDish(3,<?= $id ?>);" class="star icon18 iconUnstar " idx="9472736" starred="0" title="标记无效" style="display:none;"></a> 
						<a href="javascript:;" data-id="9472736" data-tofakeid="13073955" class="icon18 iconReply" title="回复" style="display:none;"></a> 
					</div> 
					<div class="opt msgTime right"> <?= $createtime ?></div> 
					<a class="msgSender left" href="#" target="_blank" ><?= $chusername ?></a>
					<span class="remarkName left" data-fakeid="13073955"></span> 
					<div class="wxMsg clr">地址:&nbsp;<?= $address ?><br>手机号:&nbsp;<?= $telephone ?><br><ul><?= $ordermenuliststr ?></ul> </div> 
				</div> 
				<div class="clr"></div> 
			</li> 
			<?php
					}
				}	
			?>
		</ul> 
		<div class="cLine"> 
			<div class="pageNavigator right"> 
					<span> <a href="<?= $prevpageurl ?>" class="<?= $prevclass ?>"> 上一页</a> </span> 
					<span class="pageNum">&nbsp;&nbsp;<?= $page ?>&nbsp;/&nbsp;<?= $pages ?>&nbsp;&nbsp;</span> 
					<span> <a href="<?= $nextpageurl ?>" class="<?= $nextclass ?>"> 下一页</a> </span> 
			</div> 
		</div> 
	</div> 
	<div class="sideBar"> 
		<div class="catalogList"> 
			<ul> 
				<li class="<?php if(!isset($_GET['status'])){ echo "selected";} ?>"> <a href="/customer/home.php?module=ordermanager">全部订单</a> </li> 
				<li class="<?php if($_GET['status']==='1'){ echo "selected";} ?> subCatalogList"> <a href="/customer/home.php?module=ordermanager&status=1">未送餐订单</a> </li> 
				<li class="<?php if($_GET['status']==='2'){ echo "selected";} ?> subCatalogList"> <a href="/customer/home.php?module=ordermanager&status=2">已送餐订单</a> </li>
				<li class="<?php if($_GET['status']==='3'){ echo "selected";} ?> subCatalogList"> <a href="/customer/home.php?module=ordermanager&status=3">已删除订单</a> </li> 
				<!--<li class=" subCatalogList "> <a href="#">前天</a> </li> 
				<li class=" subCatalogList "> <a href="#">更早消息</a> </li> 
				<li class=" "> <a href="#">星标消息</a> </li> -->
			</ul> 
		</div> 
	</div> 
	<div class="clr"></div> 
</div>
</div>
<script type="text/javascript">

	function sendDish(status,id){
		$.ajax({
			  type: "post",
			  url: "/customer/module/ordermanager/updatestatus.php",
			  data: { status: status, id:id},
			  dataType: 'json',
			  success:function(data){
			  	if(data.status == 1){
			  		alert(data.statusText);
			  		window.location.reload();
			  	}else if (data.status == 0){
			  		alert(data.statusText);
			  	}
			  }
		})
	}

</script>






