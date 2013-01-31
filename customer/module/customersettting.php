<div id="main" class="container">
	<div class="containerBox"> 
		<div class="boxHeader"> 
			<h2>设置</h2> 
		</div> 
		<div class="content"> 
			<div class="cLineB"> 
				<h3>修改您的账户密码 
					<a class="FAQ" href="javascript:void(0);" target="_blank">如何设置修改密码？</a> 
				</h3> 
			</div> 
			<div> 密码至少8位，采用密码加数字的形式</div> 
			<div id="settingArea" class="settingArea"> 
				<div class="userinfoArea left"> 
					<div style="padding:15px 0;"> 旧密码: <input type="password" value="" class="bindUserInput msg-input" name="old_password" id="old_passwordid" data-message="密码不能为空且至少为6位字符" value="" data-regex="^[\w\d]{6,}$"> </div>
					<div style="padding:15px 0;"> 新密码: <input type="password" value="" class="bindUserInput msg-input" name="new_password" id="new_passwordid" data-message="密码不能为空且至少为6位字符" value="" data-regex="^[\w\d]{6,}$"> </div>  
					<button id="saveSetting" class="btnGreen" onclick="submitform();">保存</button> 
				</div> 
				<div class="clr"></div> 
			</div> 
		</div> 
		<div class="sideBar"> 
			<div class="catalogList"> 
				<ul> 
					<li class="<?php if($_GET['module']==='customersettting'){ echo "selected";} ?>"> <a href="/customer/home.php?module=customersettting">修改密码</a> </li> 
					<li class="<?php if($_GET['module']==='editstorecover'){ echo "selected";} ?>"> <a href="/customer/home.php?module=editstorecover">修改饭店封面</a> </li>
				</ul> 
			</div> 
		</div> 
		<div class="clr"></div> 
	</div>
</div>
<div class="tips" style="none" id="messagetip"><div class="tipContent err"></div></div>
<script>

function submitform(){
	if(!ValidateForm.validateForm('userinfoform')){
      return;
    }
	var old_password = document.getElementById('old_passwordid').value;
	var new_password = document.getElementById('new_passwordid').value;
	$.ajax({
	  type: "post",
	  url: "/customer/uc/editpassword.php",
	  data: { old_password: old_password, new_password: new_password },
	  dataType: 'json',
	  success:function(data){
	  		alert(data.statusText);
	  }
	})
}


</script>