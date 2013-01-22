
<?php

include $_SERVER['DOCUMENT_ROOT'].'/db/db_open.php';

 $urltype = '';
 $sqltype = '';
  //菜系类别
  if (isset($_GET['type'])){
	$urltype = '&type='.intval($_GET['type']);
	$sqltype = 'where type='.$_GET['type'];
  }


//设置每一页显示的记录数
  $pagesize = 3; 

//取得记录总数$rs,计算总页数用
	$rsss = mysql_query("select count(*) from dish $sqltype");
  $myrow = mysql_fetch_array($rsss);
  $numrows = $myrow[0];

//计算总页数
  $pages = intval($numrows/$pagesize);
  if ($numrows%$pagesize){
	$pages++;
  }

  //设置页数
  if (isset($_GET['page'])){
	$page = intval($_GET['page']);
  }else{
  //设置为第一页 
    $page = 1;
  }

//计算记录偏移量
  $offset = $pagesize*($page - 1);
//读取指定记录数
  //mysql_query("SET NAMES utf8"); 
  $menurs = mysql_query("select * from dish  $sqltype order by id desc limit $offset,$pagesize;");

  //计算上一页，下一页
  $first=1;
  $prev=$page-1;
  $next=$page+1;
  $last=$pages;

  $prevpageurl = '/customer/home.php?module=menumanager&page='.$prev.$urltype;
  $nextpageurl = '/customer/home.php?module=menumanager&page='.$next.$urltype;
  
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
					<span class="go none" style="display:none;"> <input data-baseurl="/cgi-bin/contactmanagepage?t=wxm-friend&amp;lang=zh_CN&amp;type=0&amp;keyword=&amp;groupid=0&amp;pagesize=10"  class="pageIdxInput" type="text"> <button data-baseurl="/cgi-bin/contactmanagepage?t=wxm-friend&amp;lang=zh_CN&amp;type=0&amp;keyword=&amp;groupid=0&amp;pagesize=10" onclick="WXM.Plugins.pageJump(this, event, 1);" class="btnGrayS">跳转</button> </span> 
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
				if ($menurs != false){
					$i=0;
					while($menurow = mysql_fetch_array($menurs)){
						$i++;
						$name=$menurow["name"];
						$price=$menurow["price"];
					
			?> 
				<li class="listItem buddyRichInfoC"> <div class="left"> <input class="chooseFriend" type="checkbox" value="983031980"> </div>  <a target="_blank" href="#" class="msgSender f16 c-l b left" data-fakeid="983031980"><?php echo $name;?> </a> <span class="remarkName left" data-fakeid="983031980"></span> <div class="right"> <button class="msgSenderRemark right btnGrayS" data-fakeid="983031980">修改</button> <button data-gid="0" data-fid="983031980" class="putIntoGroup btnGrayS right"><?php echo $price;?> </button>  <div class="clr"></div> </div> <div class="clr"></div> </li> 
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
					<span class="go none" style="display:none;"> <input data-baseurl="/cgi-bin/contactmanagepage?t=wxm-friend&amp;lang=zh_CN&amp;type=0&amp;keyword=&amp;groupid=0&amp;pagesize=10" onkeypress="WXM.Plugins.pageJump(this, event, 1);" class="pageIdxInput" type="text"> <button data-baseurl="/cgi-bin/contactmanagepage?t=wxm-friend&amp;lang=zh_CN&amp;type=0&amp;keyword=&amp;groupid=0&amp;pagesize=10" onclick="WXM.Plugins.pageJump(this, event, 1);" class="btnGrayS">跳转</button> </span> 
				</div> 
			</div> 
		</div> 
		<div class="sideBar"> 
			<div class="catalogList"> 
				<ul> 
					<li <?php if(!$_GET['type']){ ?>class="selected "<?php }?> > <a href="/customer/home.php?module=menumanager">全部</a> </li> 
					<li <?php if($_GET['type']=='1'){ ?>class="selected "<?php }?> > <a href="/customer/home.php?module=menumanager&type=1">热菜</a> </li> 
					<li <?php if($_GET['type']=='2'){ ?>class="selected "<?php }?> > <a href="/customer/home.php?module=menumanager&type=2">凉菜</a> </li> 
					<li id="groupAdd" class="group groupAdd"><a class="icon18C iconAdd" href="/customer/home.php?module=addmenu">添加新菜</a></li>
				</ul> 
			</div> 
		</div> 
		<div class="clr"></div>
	</div>
</div>

<?php
include $_SERVER['DOCUMENT_ROOT'].'/db/db_close.php';
?>







