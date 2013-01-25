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
					<div style="padding:15px 0;"> 旧密码: <input type="password" value="" class="bindUserInput" name="old_password" id="old_passwordid"> </div>
					<div style="padding:15px 0;"> 新密码: <input type="password" value="" class="bindUserInput" name="new_password" id="new_passwordid"> </div>  
					<button id="saveSetting" class="btnGreen" onclick="submitform();">保存</button> 
				</div> 
				<div class="clr"></div> 
			</div> 
		</div> 
		<div class="sideBar"> 
			<div class="catalogList"> 
				<ul> 
					<li class="selected"> <a href="/cgi-bin/userinfopage?t=wxm-setting&amp;lang=zh_CN">修改密码</a> </li> 
				</ul> 
			</div> 
		</div> 
		<div class="clr"></div> 
	</div>
</div>
<script>

function submitform(){
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