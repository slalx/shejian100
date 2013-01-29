<div id="main" class="container">
	<div class="containerBox"> 
		<div class="boxHeader"> 
			<h2>修改饭店封面</h2> 
		</div> 
		<div class="content"> 
			<div class="cLineB"> 
				<h3>图片格式只能是png,jpg,大小不能超过2M
					<a class="FAQ" href="javascript:void(0);" target="_blank">查看示例？</a> 
				</h3> 
			</div> 
			<div> 较好的效果为大图640*320，小图80*80</div> 

			<div style="color:red;">
				<?php 
				if (isset($_GET['upload'])){
					if($_GET['upload']=='succ'){ 
						echo "封面修改成功"; 
					} else{ 
						echo "封面修改失败";
					}
				}
				?>
			</div>

			<div id="settingArea" class="settingArea"> 
				<div class="userinfoArea left"> 
					<form action='/customer/module/customersetting/uploadcover.php' method='post' name='form' enctype="multipart/form-data">  
					<div style="padding:15px 0;"> 上传封面: <input  type="file" name="file" value="" class="bindUserInput"> </div> 

					<input type="submit" value='保存' class="btnGreen">  
					</form> 
				</div> 
				<div class="clr"></div> 
			</div> 
		</div> 
		<div class="sideBar"> 
			<div class="catalogList"> 
				<ul> 
					<li class="<?php if($_GET['module']=='customersettting'){ echo "selected";} ?>"> <a href="/customer/home.php?module=customersettting">修改密码</a> </li> 
					<li class="<?php if($_GET['module']=='editstorecover'){ echo "selected";} ?>"> <a href="/customer/home.php?module=editstorecover">修改饭店封面</a> </li>
				</ul> 
			</div> 
		</div> 
		<div class="clr"></div> 
	</div>
</div>