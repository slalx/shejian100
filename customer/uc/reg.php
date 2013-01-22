<div class="rel msg-editer-wrapper"> 
	<div class="msg-editer">
		<form action="/customer/uc/savereg.php" method="post" id="storeform">
		<div>
			<label for="" class="block">店名</label> 
			<input type="text" class="msg-input" name="store_name" value="" required>
		</div>
		<div>
			<label for="" class="block">地址</label> 
			<input type="text" class="msg-input" name="store_address" value="" required>
		</div>  
		<div>
			<label for="" class="block">老板姓名</label> 
			<input type="text" class="msg-input" name="store_ownername" value="" required>
		</div>
		<div>
			<label for="" class="block">登陆名</label> 
			<input type="text" class="msg-input" id="title" name="store_username" value="" required>
		</div>
		<div>
			<label for="" class="block">密码</label> 
			<input type="password" class="msg-input" name="store_upassword" value="" required>
		</div>
		<div>
			<label for="" class="block">手机号</label> 
			<input type="tel" class="msg-input" name="store_mobilephone" value="" required>
		</div>
		<div>
			<label for="" class="block">座机号</label> 
			<input type="tel" class="msg-input" name="store_telephone" value="" required>
		</div>
		<div>
			<label for="" class="block">说明</label> 
			<textarea class="msg-input" style="height:70px;" name="store_desc" required></textarea>
		</div> 
		<input type="hidden" class="msg-input" name="store_latitude" id="store_latitudeid" value=""> 
		<input type="hidden" class="msg-input" name="store_longitude" id="store_longitudeid" value=""> 
		</form>   
	</div> 
	<p class="tc msg-btn"> 
		<a href="javascript:;" id="save" class="btnGreen" onclick="document.getElementById('storeform').submit();">完成</a> 
	</p>
	<div class="oh z shadow"> 
		<span class="left ls"></span>
		<span class="right rs"></span> 
	</div> 
	<span class="abs msg-arrow a-out" style="margin-top: 0px; "></span> 
	<span class="abs msg-arrow a-in" style="margin-top: 0px; "></span> 
</div>

<script type="text/javascript">
	if (navigator && navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
        	function(position){
        		document.getElementById('store_latitudeid').value=position.coords.latitude;
        		document.getElementById('store_longitudeid').value=position.coords.longitude;
        		
        	},
        	function(err){
        		alert('获取地理位置失败，错误代码：'+err.code);
        	} 
        );
    }
</script>

