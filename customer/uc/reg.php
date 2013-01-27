<div class="rel msg-editer-wrapper"> 
	<div class="msg-editer">
		<form action="/customer/uc/savereg.php" method="post" id="storeform">
		<div>
			<label for="" class="block">店名</label> 
			<input type="text" class="msg-input" name="store_name" id="store_nameid" value="" required>
		</div>
		<div>
			<label for="" class="block">地址</label> 
			<input type="text" class="msg-input" name="store_address" id="store_addressid" value="" required>
		</div>  
		<div>
			<label for="" class="block">老板姓名</label> 
			<input type="text" class="msg-input" name="store_ownername" id="store_ownernameid" value="" required>
		</div>
		<div>
			<label for="" class="block">登陆名</label> 
			<input type="text" class="msg-input" name="store_username" id="store_usernameid" value="" required>
		</div>
		<div>
			<label for="" class="block">密码</label> 
			<input type="password" class="msg-input" name="store_upassword" id="store_upasswordid" value="" required>
		</div>
		<div>
			<label for="" class="block">手机号</label> 
			<input type="tel" class="msg-input" name="store_mobilephone" id="store_mobilephoneid" value="" required>
		</div>
		<div>
			<label for="" class="block">座机号</label> 
			<input type="tel" class="msg-input" name="store_telephone" id="store_telephoneid" value="" required>
		</div>
		<div>
			<label for="" class="block">说明</label> 
			<textarea class="msg-input" style="height:70px;" id="store_descid" name="store_desc" required></textarea>
		</div> 
		<input type="hidden" class="msg-input" name="store_latitude" id="store_latitudeid" value=""> 
		<input type="hidden" class="msg-input" name="store_longitude" id="store_longitudeid" value=""> 
		</form>   
	</div> 
	<p class="tc msg-btn"> 
		<a href="javascript:;" id="save" class="btnGreen" onclick="submitform();">完成</a> 
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

 function GetV(id){
 	return document.getElementById(id).value;
 }

 function submitform(){
	var store_name = GetV('store_nameid');
	var store_address = GetV('store_addressid');
	var store_ownername = GetV('store_ownernameid');
	var store_username = GetV('store_usernameid');
	var store_upassword = GetV('store_upasswordid');
	var store_mobilephone = GetV('store_mobilephoneid');
	var store_telephone = GetV('store_telephoneid');
	var store_desc = GetV('store_descid');
	var store_latitude = GetV('store_latitudeid');
	var store_longitude = GetV('store_longitudeid');

	var data = {
		store_name: store_name,
		store_address: store_address,
		store_ownername: store_ownername,
		store_username: store_username,
		store_upassword: store_upassword,
		store_mobilephone: store_mobilephone,
		store_telephone: store_telephone,
		store_desc: store_desc,
		store_latitude: store_latitude,
		store_longitude: store_longitude
	}

	$.ajax({
	  type: "post",
	  url: "/customer/uc/savereg.php",
	  data: data,
	  dataType: 'json',
	  success:function(data){
	  	if(data.status == 1){
	  		Cookie.set('sj_uid',data.uid,'never',"/", document.domain);
	  		alert(data.statusText);
	  		window.location.href="/customer/home.php?direct=reg";
	  	}else if (data.status == 0){
	  		alert(data.statusText);
	  	}
	  }
	})
}   


</script>

