<style type="text/css">
	.dish_item{
		padding-bottom: 23px;
	}
</style>
<?php
include $_SERVER['DOCUMENT_ROOT'].'/db/db_open.php';

  $restaurantid = $_COOKIE["sj_uid"];
  $typeresult = mysql_query("select * from menutype where restaurantid=$restaurantid;");

  $optTpl = "<option value=\"%s\">%s</option>";
  if ($typeresult != false){
	while($row = mysql_fetch_array($typeresult)){
		$id=$row["id"];
		$name=$row["name"];
		$optstr .= sprintf($optTpl, $id, $name);
	}
	//echo $optstr;
  }			
?>

<div id="main" class="container">
    <div class="containerBox boxIndex"> 
		<div class="boxHeader"> 
			<h2>添加菜单</h2> 
		</div> 
		<div class="content"> 
			<div class="z oh msg-edit"> 
				<div class="msg-edit-area" id="msgEditArea" style="margin-top: 31px; "> 
					<div class="rel msg-editer-wrapper"> 
						<div class="msg-editer">
							<form method="post" action="./module/savemenu.php" id="savemenuform"> 
								<div class="dish_item">
									<label for="">菜名</label> 
									<input type="text" class="msg-input" value="" name="dish[0][name]"> 
									<label for="" class="dish_price">价格</label>
									<input type="text" class="msg-input" value="" name="dish[0][price]">
									<label for="">种类</label> 
									<select name="dish[0][type]">
										<?= $optstr ?>
									</select>
								</div>
								<div class="dish_item">
									<label for="">菜名</label> 
									<input type="text" class="msg-input" value="" name="dish[1][name]"> 
									<label for="" class="dish_price">价格</label>
									<input type="text" class="msg-input" value="" name="dish[1][price]">
									<label for="">种类</label> 
									<select name="dish[1][type]">
										<?= $optstr ?>
									</select>
								</div>
								<div class="dish_item">
									<label for="">菜名</label> 
									<input type="text" class="msg-input" value="" name="dish[2][name]"> 
									<label for="" class="dish_price">价格</label>
									<input type="text" class="msg-input" value="" name="dish[2][price]">
									<label for="">种类</label> 
									<select name="dish[2][type]">
										<?= $optstr ?>
									</select>
								</div>
								<div class="dish_item">
									<label for="">菜名</label> 
									<input type="text" class="msg-input" value="" name="dish[3][name]"> 
									<label for="" class="dish_price">价格</label>
									<input type="text" class="msg-input" value="" name="dish[3][price]">
									<label for="">种类</label> 
									<select name="dish[3][type]">
										<?= $optstr ?>
									</select>
								</div>
								<div class="dish_item">
									<label for="">菜名</label> 
									<input type="text" class="msg-input" value="" name="dish[4][name]"> 
									<label for="" class="dish_price">价格</label>
									<input type="text" class="msg-input" value="" name="dish[4][price]">
									<label for="">种类</label> 
									<select name="dish[4][type]">
										<?= $optstr ?>
									</select>
								</div>
							</form>
						</div> 
						<div class="oh z shadow"> 
							<span class="left ls"></span>
							<span class="right rs"></span> 
						</div> 
						<span class="abs msg-arrow a-out" style="margin-top: 0px; "></span> 
						<span class="abs msg-arrow a-in" style="margin-top: 0px; "></span> 
					</div> 
				</div> 
			</div> 
			<p class="tc msg-btn"> 
				<a href="javascript:;" id="save" class="btnGreen" onclick="document.getElementById('savemenuform').submit();">保存</a> 
			</p> 
		</div>
		<div class="clr"></div>
	</div>
</div>
<?php
	
?>








