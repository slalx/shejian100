
<?php

include $_SERVER['DOCUMENT_ROOT'].'/db/db_open.php';
include $_SERVER['DOCUMENT_ROOT'].'/publicLib/UsersInfo.php';

 $urltype = '';
 $sqltype = '';
  //菜系类别
  if (isset($_GET['type'])){
	$urltype = '&type='.intval($_GET['type']);
	$sqltype = 'where type='.$_GET['type'];
  }

  //设置页数
  if (isset($_GET['page'])){
	$page = intval($_GET['page']);
  }else{
  //设置为第一页 
    $page = 1;
  }

  $orderobj = new UsersInfo('','','','','');

//取得记录总数$rs,计算总页数用
  $pages = $orderobj->getTotalOrdersCount($page,3,$sqltype);


//读取指定记录数

  $result = $orderobj->getOrdersByDate($page,3,$sqltype);

  //计算上一页，下一页
  $first=1;
  $prev=$page-1;
  $next=$page+1;
  $last=$pages;

  $prevpageurl = '/customer/home.php?module=usermanager&page='.$prev.$urltype;
  $nextpageurl = '/customer/home.php?module=usermanager&page='.$next.$urltype;
  
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


<div id="main" class="container">
    <div class="containerBox boxIndex"> 
		<div class="boxHeader"> 
			<h2>菜单管理</h2> 
		</div> 
		<div class="content"> 
			<div class="cLine"> 
				<div class="pageNavigator right"> 
					<span> <a href="<?= $prevpageurl ?>" class="prePage <?= $prevclass?>"> 上一页</a> </span> 
					<span class="pageNum">&nbsp;&nbsp;<?= $page ?>&nbsp;/&nbsp;<?= $pages ?>&nbsp;&nbsp;</span> 
					<span> <a href="<?= $nextpageurl ?>" class="nextPage <?= $nextclass?>"> 下一页</a> </span> 
				</div> 
				<div class="clr"></div> 
			</div> 
			<div class="listTitle"> 
				<div class="left title msg">
					<input type="checkbox" id="selectAll">账号
				</div> 
				<div class="right title opt">操作</div> 
			</div> 
			<ul id="listContainer">
			<?php
				if ($result != false){
					$i=0;
					while($row = mysql_fetch_array($result)){
						$i++;
						$name=$row["username"];
						$address=$row["address"];
					
			?> 
				<li class="listItem buddyRichInfoC"> <div class="left"> <input class="chooseFriend" type="checkbox" value="983031980"> </div>  <a target="_blank" href="#" class="msgSender f16 c-l b left" data-fakeid="983031980"><?php echo $name;?> </a> <span class="remarkName left" data-fakeid="983031980"></span> <div class="right"> <button class="msgSenderRemark right btnGrayS" data-fakeid="983031980">修改</button>  <div class="clr"></div> </div> <div class="clr"></div> </li> 
			<?php
					}
				}	
			?>
			</ul> 
			<div class="cLine"> 
				<div class="pageNavigator right"> 
					<span> <a href="<?= $prevpageurl ?>" class="prePage <?= $prevclass?>"> 上一页</a> </span> 
					<span class="pageNum">&nbsp;&nbsp;<?= $page ?>&nbsp;/&nbsp;<?= $pages ?>&nbsp;&nbsp;</span> 
					<span> <a href="<?= $nextpageurl ?>" class="nextPage <?= $nextclass?>"> 下一页</a> </span> 
				</div> 
			</div> 
		</div> 
		<div class="sideBar"> 
			<div class="catalogList"> 
				<ul> 
					<li <?php if(!$_GET['type'] && $_GET['type']!=='0'){ ?>class="selected "<?php }?> > <a href="/customer/home.php?module=usermanager">全部</a> </li> 
					<li <?php if($_GET['type']=='0'){ ?>class="selected "<?php }?> > <a href="/customer/home.php?module=usermanager&type=0">微信用户</a> </li> 
					</li>
				</ul> 
			</div> 
		</div> 
		<div class="clr"></div>
	</div>
</div>

<?php
include $_SERVER['DOCUMENT_ROOT'].'/db/db_close.php';
?>







