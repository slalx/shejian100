<?php
header('Content-Type: text/html; charset=utf-8');
include $_SERVER['DOCUMENT_ROOT'].'/db/db_open.php';
//包含分页类
include $_SERVER['DOCUMENT_ROOT'].'/publicLib/page.php';

 $urltype = '';
 $sqltype = '';
  //饭馆名称
  if (isset($_GET['name'])){
	//$urltype = '&type='.intval($_GET['type']);
	$sqlcondition = "where name like '%".$_GET['name']."%'";
  }
  //设置页数
  if (isset($_GET['page'])){
	$page = intval($_GET['page']);
  }else{
  //设置为第一页 
    $page = 1;
  }

   $menupage = new Page($page, 3, $sqlcondition, 'dish');
   $menuresult= $menupage->sqlQueryResults();

   //$menu = new Menu('','');
   //print_r($menu->getMenuList($menuresult));

?>

<ul id="listContainer">
	<?php
	if ($menuresult != false){
		while($menurow = mysql_fetch_array($menuresult)){

			$name=$menurow["name"];
			$price=$menurow["price"];
		
	?> 
	<li class="listItem buddyRichInfoC"> <div class="left"> <input class="chooseFriend" type="checkbox" value="983031980"> </div>  <a target="_blank" href="#" class="msgSender f16 c-l b left" data-fakeid="983031980"><?php echo $name;?> </a> <span class="remarkName left" data-fakeid="983031980"></span> <div class="right"> <button class="msgSenderRemark right btnGrayS" data-fakeid="983031980">修改</button> <button data-gid="0" data-fid="983031980" class="putIntoGroup btnGrayS right"><?php echo $price;?> </button>  <div class="clr"></div> </div> <div class="clr"></div> </li> 
	<?php
		}
	}	
	?>
</ul> 

<?php
include $_SERVER['DOCUMENT_ROOT'].'/db/db_close.php';
?>