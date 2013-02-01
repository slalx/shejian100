<div class="rel msg-editer-wrapper loginform"> 
	<div class="msg-editer">
		<form method="post" id="storeform">
		<div>
			<label for="" class="block">用户名</label> 
			<input type="text" class="msg-input" id="owner_username" value="" data-message="登陆名不能为空且长度不能超过10个字母或数字"  data-regex="^[1-9a-zA-Z]{1,10}$">
		</div> 
		<div>
			<label for="" class="block">密码</label> 
			<input type="password" class="msg-input" id="owner_password" value="" data-message="密码不能为空且至少为6位字符"  data-regex="^[\w\d]{6,}$">
		</div>
		</form>   
	</div> 
	<p class="tc msg-btn"> 
		<a href="javascript:;" id="save" class="btnGreen" onclick="submitform();">登陆</a> 
	</p>
	<div class="oh z shadow"> 
		<span class="left ls"></span>
		<span class="right rs"></span> 
	</div> 
	<span class="abs msg-arrow a-out" style="margin-top: 0px; "></span> 
	<span class="abs msg-arrow a-in" style="margin-top: 0px; "></span> 
</div>
<script type="text/javascript" src="/resource/js/cookie.js"></script>
<script>

function submitform(){

 	if(!ValidateForm.validateForm('storeform')){
 		return;
 	}

	var usernameval = document.getElementById('owner_username').value;
	var passwordval = document.getElementById('owner_password').value;
	$.ajax({
	  type: "post",
	  url: "/customer/uc/certification.php",
	  data: { owner_username: usernameval, owner_password: passwordval },
	  dataType: 'json',
	  success:function(data){
	  	if(data.status == 1){
	  		Cookie.set('sj_uid',data.uid,'never',"/", document.domain);
	  		//alert(data.statusText);
	  		window.location.href="/customer/home.php";
	  	}else if (data.status == 0){
	  		alert(data.statusText);
	  	}
	  }
	})
}
</script>
<script type="text/javascript" src="/resource/js/validateform.js"></script>