
<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.4"></script>
<div class="rel msg-editer-wrapper"> 
	<div class="msg-editer">
		<form action="/customer/uc/savereg.php" method="post" id="storeform">
		<div>
			<label for="" class="block">用户名<span style="color:red">&nbsp;&nbsp;*</span></label> 
			<input type="text" class="msg-input" name="store_username" id="store_usernameid" data-message="登陆名不能为空且长度不能超过18个字母或数字" value="" data-regex="^[0-9a-zA-Z]{1,18}$">
		</div>
		<div>
			<label for="" class="block">密码<span style="color:red">&nbsp;&nbsp;*</span></label> 
			<input type="password" class="msg-input" name="store_upassword" id="store_upasswordid" data-message="密码不能为空且至少为6位字符" value="" data-regex="^[\w\d]{6,}$">
		</div>
		<div>
			<label for="" class="block">店名<span style="color:red">&nbsp;&nbsp;*</span></label> 
			<input type="text" class="msg-input" name="store_name" id="store_nameid" data-message="店名不能为空且长度不能超过20字" value="" data-regex="^[\u4e00-\u9fa5]{1,20}$">
		</div>
		<div>
			<label for="" class="block">地址<span style="color:red">&nbsp;&nbsp;*</span></label>
			<div style="margin-bottom:10px;">
			    <select id="selProvance" onChange="chgProvinces('selProvance','selCity','selArea')">
			        <option></option>
			    </select>
			    <select id="selCity" onChange="chgCitys('selCity','selArea')">
			        <option></option>
			    </select>
			    <select id="selArea">
			        <option></option>
			    </select>
			    <a href="javascript:void(0);" onclick="showMapDialog(this);">在地图上标注</a>
		    </div>
    		<input type="text" class="msg-input" name="store_address" id="store_addressid" data-message="地址不能为空且长度不能超过100字" value="" data-regex="^[\u4e00-\u9fa50-9a-zA-Z]{1,100}$">
		</div>
		<div>
			<label for="" class="block">营业时间<span style="color:red">&nbsp;&nbsp;*</span></label> 
				<span>开始:&nbsp;&nbsp;</span>
			    <select id="starttime" >
			        <option>0</option>
			        <option>1</option>
			        <option>2</option>
			        <option>3</option>
			        <option>4</option>
			        <option>5</option>
			        <option>6</option>
			        <option>7</option>
			        <option>8</option>
			        <option>9</option>
			        <option>10</option>
			        <option>11</option>
			        <option>12</option>
			        <option>13</option>
			        <option>14</option>
			        <option>15</option>
			        <option>16</option>
			        <option>17</option>
			        <option>18</option>
			        <option>19</option>
			        <option>20</option>
			        <option>21</option>
			        <option>22</option>
			        <option>23</option>
			    </select>
			    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			    <span>结束:&nbsp;&nbsp;</span>
			    <select id="endtime">
			        <option>0</option>
			        <option>1</option>
			        <option>2</option>
			        <option>3</option>
			        <option>4</option>
			        <option>5</option>
			        <option>6</option>
			        <option>7</option>
			        <option>8</option>
			        <option>9</option>
			        <option>10</option>
			        <option>11</option>
			        <option>12</option>
			        <option>13</option>
			        <option>14</option>
			        <option>15</option>
			        <option>16</option>
			        <option>17</option>
			        <option>18</option>
			        <option>19</option>
			        <option>20</option>
			        <option>21</option>
			        <option>22</option>
			        <option>23</option>
			    </select>
		</div>  
		<div>
			<label for="" class="block">老板姓名<span style="color:red">&nbsp;&nbsp;*</span></label> 
			<input type="text" class="msg-input" name="store_ownername" id="store_ownernameid" data-message="老板姓名不能为空且长度不能超过20字" value="" data-regex="^[\u4e00-\u9fa5]{1,20}$">
		</div>
		<div>
			<label for="" class="block">手机号<span style="color:red">&nbsp;&nbsp;*</span></label> 
			<input type="tel" class="msg-input" name="store_mobilephone" id="store_mobilephoneid" value="" data-message="手机号不能为空且为11位数字" data-regex="^[0-9]{11,11}$">
		</div>
		<div>
			<label for="" class="block">座机号</label> 
			<input type="tel" class="msg-input" name="store_telephone" id="store_telephoneid" value="" data-message="座机号应为7-12位数字" data-regex="^[0-9\-]{0,13}$">
		</div>
		<div>
			<label for="" class="block">说明<span style="color:red">&nbsp;&nbsp;*</span></label> 
			<textarea class="msg-input" style="height:70px;" id="store_descid" name="store_desc" data-message="说明不能为空且为10-140个字" data-regex="^.{10,140}$"></textarea>
		</div> 
		<input type="hidden" class="msg-input" name="store_latitude" id="store_latitudeid" value="" data-message="请标注地图" data-regex="^.+$"> 
		<input type="hidden" class="msg-input" name="store_longitude" id="store_longitudeid" value="" data-message="请标注地图" data-regex="^.+$"> 
		</form>   
	</div> 
	<p class="tc msg-btn"> 
		<a href="javascript:;" id="save" class="btnGreen" onclick="submitform(this);">完成</a> 
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

document.body.onload = function(){
	loadData('selProvance', 'selCity', 'selArea');
};

 function GetV(id){
 	return document.getElementById(id).value;
 }


 function submitform(obj){

 	if(!ValidateForm.validateForm('storeform')){
 		return;
 	}
 	//获得省市区的字符串组合
	var provinceandcitystr = getSelectedValue('selProvance')+getSelectedValue('selCity')+getSelectedValue('selArea');

	var store_name = GetV('store_nameid');
	var store_address = provinceandcitystr+GetV('store_addressid');
	var store_ownername = GetV('store_ownernameid');
	var store_username = GetV('store_usernameid');
	var store_upassword = GetV('store_upasswordid');
	var store_mobilephone = GetV('store_mobilephoneid');
	var store_telephone = GetV('store_telephoneid');
	var store_desc = GetV('store_descid');
	var store_latitude = GetV('store_latitudeid');
	var store_longitude = GetV('store_longitudeid');

	var store_starttime = getSelectedValue('starttime');
	var store_endtime = getSelectedValue('endtime');
	if(parseInt(store_starttime)>parseInt(store_endtime)){
		ValidateForm.showTip('开始时间不能大于打烊时间');
		return;
	}
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
		store_longitude: store_longitude,
		store_starttime :store_starttime,
		store_endtime: store_endtime
	}
	addClass(obj,'btnDisable');
	$.ajax({
	  type: "post",
	  url: "/customer/uc/savereg.php",
	  data: data,
	  dataType: 'json',
	  success:function(data){
	  	if(data.status == 1){
	  		Cookie.set('sj_uid',data.uid,'never',"/", document.domain);
	  		//alert(data.statusText);
	  		window.location.href="/customer/home.php?direct=reg";
	  	}else if (data.status == 0){
	  		ValidateForm.showTip(data.statusText);
	  	}
	  	removeClass(obj,'btnDisable');
	  }
	})
}   

function createMap(){
	var lng = document.getElementById('store_longitudeid');
	var lat = document.getElementById('store_latitudeid');

	var provinceandcitystr = getSelectedValue('selProvance')+getSelectedValue('selCity')+getSelectedValue('selArea');
	dialogContent.innerHTML = '';
	var map = new BMap.Map("dialogContent");
		map.centerAndZoom(provinceandcitystr);
		map.addControl(new BMap.NavigationControl());
		map.addControl(new BMap.NavigationControl({anchor: BMAP_ANCHOR_BOTTOM_RIGHT, type: BMAP_NAVIGATION_CONTROL_ZOOM}));   
		map.addEventListener("click",function(e){
			map.clearOverlays();
			var marker1 = new BMap.Marker(new BMap.Point(e.point.lng, e.point.lat));  // 创建标注
			map.addOverlay(marker1); 
			if(!document.getElementById('store_latitudeid').value) {
				lng.value = e.point.lng;
				lat.value = e.point.lat;
			}    
	});
}
function getSelectedValue(selectid){
	var sel=document.getElementById(selectid);
	var selvalue= sel.options[sel.options.selectedIndex].text;
	return selvalue;
}
function showMapDialog(obj){
	var sd = new SimpleDialog({
		title:'标注地图',
		content:"",
		width:'600px',
		height:'400px',
		top:'5px',
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
<script type="text/javascript" src="/resource/js/simpledialog.js"></script>
<script type="text/javascript" src="/resource/js/provinceandcity.js"></script>
