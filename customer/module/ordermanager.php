
<?php

include $_SERVER['DOCUMENT_ROOT'].'/db/db_open.php';
include $_SERVER['DOCUMENT_ROOT'].'/publicLib/Order.php';

 $urltype = '';
 $sqltype = '';
  //请求条件
  if (isset($_GET['date'])){
	$urltype = '&date='.intval($_GET['date']);
	$sqltype = 'where createtime='.$_GET['date'];
  }

  //现在是第几页
  if (isset($_GET['page'])){
	$page = intval($_GET['page']);
  }else{
  //设置为第一页 
    $page = 1;
  }

  $orderobj = new Order('','','','','');

//取得记录总数$rs,计算总页数用
  $pages = $orderobj->getTotalOrdersCount($page,3,$sqltype);


//读取指定记录数

  $result = $orderobj->getOrdersByDate($page,3,$sqltype);

  //计算上一页，下一页
  $first=1;
  $prev=$page-1;
  $next=$page+1;
  $last=$pages;

  $prevpageurl = '/customer/home.php?module=ordermanager&page='.$prev.$urltype;
  $nextpageurl = '/customer/home.php?module=ordermanager&page='.$next.$urltype;
  
  $prevclass = '';
  $nextclass = '';

  if($pages == 1){
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

?>

<style type="text/css">
.time,.msg,.opt{
 text-align: center;
 width: 125px;
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
						$userid=$row["userid"];
						$address=$row["address"];
						$telephone = $row["telephone"];
						$createtime = $row["createtime"];
						$orderform = $row["orderinfo"];
					
			?>  
			<li class="msgListItem buddyRichInfoC " id="msgListItem9472736" data-id="9472736"> <a target="_blank" href="#" class="msgSender left"> <img height="48" width="48" src="http://res.wx.qq.com/mpres/htmledition/images/favicon125122.ico" data-fakeid="13073955" class="avatar left"> </a> <div class="wxMsgArea"> <div class="opt oper right"> <a href="javascript:;" class="icon18 iconEdit" data-fakeid="13073955" title="修改备注"></a> <a href="javascript:;" class="save icon18 iconSave vh" idx="9472736" data-type="1" title="保存为素材"></a> <a href="/cgi-bin/downloadfile?msgid=9472736&amp;source=" class="icon18 iconDownload vh" target="_blank" idx="9472736" title="下载"></a> <a href="javascript:;" class="star icon18 iconUnstar " idx="9472736" starred="0" title="对此条消息标星"></a> <a href="javascript:;" data-id="9472736" data-tofakeid="13073955" class="icon18 iconReply" title="快捷回复"></a> </div> <div class="opt msgTime right"> <?= $createtime ?></div> <a class="msgSender left" href="/cgi-bin/singlemsgpage?fromfakeid=13073955&amp;msgid=&amp;source=&amp;count=20&amp;t=wxm-singlechat&amp;lang=zh_CN" target="_blank" data-fakeid="13073955"><?= $userid ?></a><span class="remarkName left" data-fakeid="13073955"></span> <div class="wxMsg clr"> <?= $address ?>&nbsp;手机号&nbsp;<?= $telephone ?>:<br><?= $orderform ?> </div> </div> <div class="clr"></div> <div id="quickReplyBox9472736" class="quickReplyBox"> <div class="cLine c-b">快速回复:</div> <div class="cLine"> <textarea class="quickReplyTxt"></textarea> </div> <div class="cLine"> <button class="btnGreenS quickReplyOK">发送</button> <a class="quickReplyPickup" href="javascript:;">收起</a> </div> </div> </li> 
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
				<li class="selected "> <a href="#">全部订单</a> </li> 
				<!--<li class=" subCatalogList "> <a href="#">今天</a> </li> 
				<li class=" subCatalogList "> <a href="#">昨天</a> </li> 
				<li class=" subCatalogList "> <a href="#">前天</a> </li> 
				<li class=" subCatalogList "> <a href="#">更早消息</a> </li> 
				<li class=" "> <a href="#">星标消息</a> </li> -->
			</ul> 
		</div> 
	</div> 
	<div class="clr"></div> 
</div>
</div>