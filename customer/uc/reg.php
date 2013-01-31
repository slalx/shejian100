
<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.4"></script>
<div class="rel msg-editer-wrapper"> 
	<div class="msg-editer">
		<form action="/customer/uc/savereg.php" method="post" id="storeform">
		<div>
			<label for="" class="block">店名</label> 
			<input type="text" class="msg-input" name="store_name" id="store_nameid" data-message="店名不能为空且长度不能超过20字" value="" data-regex="^[\u4e00-\u9fa5]{1,20}$">
		</div>
		<div>
			<label for="" class="block">地址</label> 
			<input type="text" class="msg-input" name="store_address" id="store_addressid" data-message="地址不能为空且长度不能超过100字" value="" data-regex="^[\u4e00-\u9fa50-9a-zA-Z]{1,100}$">
			<a href="javascript:void(0);" onclick="showMapDialog(this);">标注</a>
		</div>  
		<div>
			<label for="" class="block">老板姓名</label> 
			<input type="text" class="msg-input" name="store_ownername" id="store_ownernameid" data-message="老板姓名不能为空且长度不能超过20字" value="" data-regex="^[\u4e00-\u9fa5]{1,20}$">
		</div>
		<div>
			<label for="" class="block">登陆名</label> 
			<input type="text" class="msg-input" name="store_username" id="store_usernameid" data-message="登陆名不能为空且长度不能超过10个字母或数字" value="" data-regex="^[0-9a-zA-Z]{1,10}$">
		</div>
		<div>
			<label for="" class="block">密码</label> 
			<input type="password" class="msg-input" name="store_upassword" id="store_upasswordid" data-message="密码不能为空且至少为6位字符" value="" data-regex="^[\w\d]{6,}$">
		</div>
		<div>
			<label for="" class="block">手机号</label> 
			<input type="tel" class="msg-input" name="store_mobilephone" id="store_mobilephoneid" value="" data-message="手机号不能为空且为11位数字" data-regex="^[0-9]{11,11}$">
		</div>
		<div>
			<label for="" class="block">座机号</label> 
			<input type="tel" class="msg-input" name="store_telephone" id="store_telephoneid" value="" data-message="座机号不能为空且为7-11位数字" data-regex="^[0-9]{7,11}$">
		</div>
		<div>
			<label for="" class="block">说明</label> 
			<textarea class="msg-input" style="height:70px;" id="store_descid" name="store_desc" data-message="说明不能为空且为10-140个字" data-regex="^.{10,140}$"></textarea>
		</div> 
		<input type="hidden" class="msg-input" name="store_latitude" id="store_latitudeid" value="" data-message="请标注地图" data-regex="^.+$"> 
		<input type="hidden" class="msg-input" name="store_longitude" id="store_longitudeid" value="" data-message="请标注地图" data-regex="^.+$"> 
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

 	if(!ValidateForm.validateForm('storeform')){
 		return;
 	}

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

function createMap(){
	var lng = document.getElementById('store_longitudeid');
	var lat = document.getElementById('store_latitudeid');

	var map = new BMap.Map("dialogContent");
		map.centerAndZoom(new BMap.Point(116.404, 39.915), 14);
		map.addEventListener("click",function(e){
			var marker1 = new BMap.Marker(new BMap.Point(e.point.lng, e.point.lat));  // 创建标注
			map.addOverlay(marker1); 
			if(!document.getElementById('store_latitudeid').value) {
				lng.value = e.point.lng;
				lat.value = e.point.lat;
			}    
	});
}
function showMapDialog(obj){
	var sd = new SimpleDialog({
		title:'标注地图',
		content:"",
		width:'600px',
		height:'400px',
		confirm:function(){
			//saveEdit(id);
			obj.innerHTML = '已标注';
		},
		aftershow:function(){
			createMap();
		},
		cancel:function(){}
	});	
}


</script>
<script type="text/javascript" src="/resource/js/validateform.js"></script>
<script type="text/javascript" src="/resource/js/simpledialog.js"></script>
