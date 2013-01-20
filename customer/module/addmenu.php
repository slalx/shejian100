<style type="text/css">
	.dish_item{
		padding-bottom: 23px;
	}
</style>


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
									<input type="text" class="msg-input" value="" name="dish_name"> 
									<label for="" class="dish_price">价格</label>
									<input type="text" class="msg-input" value="" name="dish_price">
									<label for="">种类</label> 
									<select name="dish_type" name="dish_type">
										<option value="1">热菜</option>
										<option value="2">凉菜</option>
									</select>
								</div>
								<div class="dish_item">
									<label for="">菜名</label> 
									<input type="text" class="msg-input" value="" name="dish_name"> 
									<label for="" class="dish_price">价格</label>
									<input type="text" class="msg-input" value="" name="dish_price">
									<label for="">种类</label> 
									<select name="dish_type" name="dish_type">
										<option value="1">热菜</option>
										<option value="2">凉菜</option>
									</select>
								</div>
								<div class="dish_item">
									<label for="">菜名</label> 
									<input type="text" class="msg-input" value="" name="dish_name"> 
									<label for="" class="dish_price">价格</label>
									<input type="text" class="msg-input" value="" name="dish_price">
									<label for="">种类</label> 
									<select name="dish_type" name="dish_type">
										<option value="1">热菜</option>
										<option value="2">凉菜</option>
									</select>
								</div>
								<div class="dish_item">
									<label for="">菜名</label> 
									<input type="text" class="msg-input" value="" name="dish_name"> 
									<label for="" class="dish_price">价格</label>
									<input type="text" class="msg-input" value="" name="dish_price">
									<label for="">种类</label> 
									<select name="dish_type" name="dish_type">
										<option value="1">热菜</option>
										<option value="2">凉菜</option>
									</select>
								</div>
								<div class="dish_item">
									<label for="">菜名</label> 
									<input type="text" class="msg-input" value="" name="dish_name"> 
									<label for="" class="dish_price">价格</label>
									<input type="text" class="msg-input" value="" name="dish_price">
									<label for="">种类</label> 
									<select name="dish_type" name="dish_type">
										<option value="1">热菜</option>
										<option value="2">凉菜</option>
									</select>
								</div>
								<div class="dish_item">
									<label for="">菜名</label> 
									<input type="text" class="msg-input" value="" name="dish_name"> 
									<label for="" class="dish_price">价格</label>
									<input type="text" class="msg-input" value="" name="dish_price">
									<label for="">种类</label> 
									<select name="dish_type" name="dish_type">
										<option value="1">热菜</option>
										<option value="2">凉菜</option>
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









