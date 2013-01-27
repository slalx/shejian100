
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
				<div class="left"> 
					<div id="allGroup" data-gid="0" class="selectArea left">
						<button id="putIntoGroupAll" class="btnGrayS left"><a class="icon18C iconAdd" href="/customer/home.php?module=addmenu">添加新菜</a></button>
					</div> 
					<div class="clr"></div> 
				</div> 
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
					while($menurow = mysql_fetch_array($menurs)){
						$name=$menurow["name"];
						$price=$menurow["price"];
						$mid = $menurow["id"];
					
			?> 
				<li class="listItem buddyRichInfoC"> <div class="left"> <input class="chooseFriend" type="checkbox" value="<?= $mid ?>"> </div>  <a target="_blank" href="#" class="msgSender f16 c-l b left" data-fakeid="983031980"><?php echo $name;?> </a> <span class="remarkName left" data-fakeid="983031980"></span> <div class="right"> <button class="msgSenderRemark right btnGrayS" data-fakeid="983031980" onclick="showEditDialog(<?php echo "'$mid'".",'$name'".",'$price'";?>);">修改</button> <button data-gid="0" data-fid="983031980" class="putIntoGroup btnGrayS right"><?php echo $price;?> </button>  <div class="clr"></div> </div> <div class="clr"></div> </li> 
			<?php
					}
				}	
			?>
			</ul> 
			<div class="cLine">
			<div id="allGroup" data-gid="0" class="selectArea left">
						<button id="putIntoGroupAll" class="btnGrayS left"><a class="" href="javascript:;" onclick="deleteMenus();"><span class="icon18C iconDel" style="width:6px;height:17px;display:inline-block;"></span>删除菜单</a></button>
					</div>  
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
					<?php 
						  $restaurantid = $_COOKIE["sj_uid"];
						  $typeresult = mysql_query("select * from menutype where restaurantid=$restaurantid;");
						  if ($typeresult != false){
							while($row = mysql_fetch_array($typeresult)){
								$id=$row["id"];
								$name=$row["name"];
					?>
					<li <?php if($_GET['type']==$id){ ?>class="selected "<?php }?> > <a href="/customer/home.php?module=menumanager&type=<?= $id?>"><?= $name?></a> </li> 
					<?php
							}
						   }
					?>
					<li id="groupEdit" style="display:none;"><span><input class="groupInput" type="text" onblur="saveType();" id="groupEditValue"></span></li> 
					<li id="groupAdd" class="group groupAdd"><a class="icon18C iconAdd" href="javascript:void(0);" onclick="document.getElementById('groupEdit').style.display=''";>添加分类</a></li>
				</ul> 
			</div> 
		</div> 
		<div class="clr"></div>
	</div>
</div>
<script type="text/javascript">
	function saveType(){
		var typeobj = document.getElementById('groupEditValue');
		var type = typeobj.value;
		typeobj.style.display = "none";
		$.ajax({
			  type: "post",
			  url: "/customer/module/menumanager/saveType.php",
			  data: { menutype: type},
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

	function deleteMenus(){
		var lc =document.getElementById('listContainer');
		var checkboxes = lc.getElementsByTagName('input');

		var idstr='';
		for(var i=0,l=checkboxes.length; i<l; i++){
			var onecheckbox = checkboxes[i];
			if(onecheckbox.checked){
				idstr=idstr +onecheckbox.value+',';
			}
		}
		if(idstr){
			idstr = idstr.substring(0,idstr.length - 1);
		}

		if(idstr){
			$.ajax({
			  type: "post",
			  url: "/customer/module/menumanager/deleteMenu.php",
			  data: { ids: idstr},
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
		}else{
			alert('请选择要删除的菜单');
		}
	}
</script>
<script type="text/javascript" src="/resource/js/simpledialog.js"></script>
<script type="text/javascript">
	function showEditDialog(id,name,price){
		var content = '<label>菜名：</label><input id="nameInput" class="textInput" type="text" value="'+name+'">'+
		'<label>菜价：</label><input id="priceInput" class="textInput" type="text" value="'+price+'">';

		var sd = new SimpleDialog({
			title:'修改菜单',
			content:content,
			confirm:function(){

			},
			cancel:function(){}
		});
	}
</script>
<?php
include $_SERVER['DOCUMENT_ROOT'].'/db/db_close.php';
?>







