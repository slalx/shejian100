
<?php

include '../../db/db_open.php';

//设置每一页显示的记录数
  $pagesize = 3; 

//取得记录总数$rs，计算总页数用

　$rsss = mysql_query("select count(*) from dish",$con);
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
  $menurs = mysql_query("select * from dish order by id desc limit $offset,$pagesize;",$con);

?>


<div id="main" class="container">
    <div class="containerBox boxIndex"> 
		<div class="boxHeader"> 
			<h2>菜单管理</h2> 
		</div> 
		<div class="content"> 
			<div class="cLine"> 
				<div class="pageNavigator right"> 
					<span> <a href="javascript:;" class="prePage textDisable "> 上一页</a> </span> 
					<span class="pageNum">&nbsp;&nbsp;1&nbsp;/&nbsp;1&nbsp;&nbsp;</span> 
					<span> <a href="javascript:;" class="nextPage textDisable "> 下一页</a> </span> 
					<span class="go"> <input data-baseurl="/cgi-bin/contactmanagepage?t=wxm-friend&amp;lang=zh_CN&amp;type=0&amp;keyword=&amp;groupid=0&amp;pagesize=10" onkeypress="WXM.Plugins.pageJump(this, event, 1);" class="pageIdxInput" type="text"> <button data-baseurl="/cgi-bin/contactmanagepage?t=wxm-friend&amp;lang=zh_CN&amp;type=0&amp;keyword=&amp;groupid=0&amp;pagesize=10" onclick="WXM.Plugins.pageJump(this, event, 1);" class="btnGrayS">跳转</button> </span> 
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
				if ($myrow = mysql_fetch_array($rs)){
					$i=0;
					do{
　　　　					$i++;
			?> 
				<li class="listItem buddyRichInfoC"> <div class="left"> <input class="chooseFriend" type="checkbox" value="983031980"> </div>  <a target="_blank" href="#" class="msgSender f16 c-l b left" data-fakeid="983031980">＜?=$myrow["name"]?＞</a> <span class="remarkName left" data-fakeid="983031980"></span> <div class="right"> <button class="msgSenderRemark right btnGrayS" data-fakeid="983031980">修改</button> <button data-gid="0" data-fid="983031980" class="putIntoGroup btnGrayS right">＜?=$myrow["price"]?＞</button>  <div class="clr"></div> </div> <div class="clr"></div> </li> 
			<?php
					}
					while ($myrow = mysql_fetch_array($rs));
				}
			?>
			</ul> 
			<div class="cLine"> 
				<div class="pageNavigator right"> 
					<span> <a href="javascript:;" class="prePage textDisable "> 上一页</a> </span> 
					<span class="pageNum">&nbsp;&nbsp;1&nbsp;/&nbsp;1&nbsp;&nbsp;</span> 
					<span> <a href="javascript:;" class="nextPage textDisable "> 下一页</a> </span> 
					<span class="go"> <input data-baseurl="/cgi-bin/contactmanagepage?t=wxm-friend&amp;lang=zh_CN&amp;type=0&amp;keyword=&amp;groupid=0&amp;pagesize=10" onkeypress="WXM.Plugins.pageJump(this, event, 1);" class="pageIdxInput" type="text"> <button data-baseurl="/cgi-bin/contactmanagepage?t=wxm-friend&amp;lang=zh_CN&amp;type=0&amp;keyword=&amp;groupid=0&amp;pagesize=10" onclick="WXM.Plugins.pageJump(this, event, 1);" class="btnGrayS">跳转</button> </span> 
				</div> 
			</div> 
		</div> 
		<div class="sideBar"> 
			<div class="catalogList"> 
				<ul> 
					<li class="selected "> <a href="#">全部</a> </li> 
					<li class=" "> <a href="#">热菜</a> </li> 
					<li class=" "> <a href="#">凉菜</a> </li> 
					<li id="groupAdd" class="group groupAdd"><a class="icon18C iconAdd" href="javascript:;">添加新菜</a></li>
				</ul> 
			</div> 
		</div> 
		<div class="clr"></div>
	</div>
</div>

<?php
include '../../db/db_close.php';
?>







