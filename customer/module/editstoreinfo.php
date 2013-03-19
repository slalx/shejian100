<style type="text/css">
.msg-input,
.cover-area,
.msg-txta {
    background-color: #fff;
    border: 1px solid #d3d3d3;
    color: #666;
    max-width: 480px;
    padding: 2px 8px;
    width: 480px;
    height: 26px;
}
.msg-input .msg-txta {
    color: #666;
    height: 60px;
}
.userinfoArea{
	padding-left: 100px;
}
</style>
<?php
	include_once $_SERVER['DOCUMENT_ROOT'].'/db/db_open.php';
	include_once $_SERVER['DOCUMENT_ROOT'].'/publicLib/Store.php';
	$customerid = $_COOKIE["sj_uid"];
	$store = new Store('','','','','','');
	$rs = $store->getOneStoreById($customerid);
	$rows= mysql_fetch_array($rs);
	if($rows){
		$storename = $rows[name];
		$storeaddress = $rows[address];
		$storeownername = $rows[ownername];
		$storemobile = $rows[mobilephone];
		$storetelephone = $rows[telephone];
		$storelatitude = $rows[latitude];
		$storelontitude = $rows[longitude];
		$storedesc= $rows[storedesc];
	}
?>
<div id="main" class="container">
	<div class="containerBox"> 
		<div class="boxHeader"> 
			<h2>设置</h2> 
		</div> 
		<div class="content"> 
			<div class="cLineB"> 
				<h3>修改店铺信息 
					
				</h3> 
			</div> 
			<div id="settingArea" class="settingArea"> 
				<div class="userinfoArea" id="storeform"> 
							<div>
								<label for="" class="block">店名<span style="color:red">&nbsp;&nbsp;*</span></label> 
								<input type="text" class="msg-input" name="store_name" id="store_nameid" data-message="店名不能为空且长度不能超过20字" value="<?= $storename ?>" data-regex="^[\u4e00-\u9fa5]{1,20}$">
							</div>
							<div>
								<label for="" class="block">老板姓名<span style="color:red">&nbsp;&nbsp;*</span></label> 
								<input type="text" class="msg-input" name="store_ownername" id="store_ownernameid" data-message="老板姓名不能为空且长度不能超过20字" value="<?= $storeownername ?>" data-regex="^[\u4e00-\u9fa5]{1,20}$">
							</div>
							<div>
								<label for="" class="block">手机号<span style="color:red">&nbsp;&nbsp;*</span></label> 
								<input type="tel" class="msg-input" name="store_mobilephone" id="store_mobilephoneid" value="<?= $storemobile ?>" data-message="手机号不能为空且为11位数字" data-regex="^[0-9]{11,11}$">
							</div>
							<div>
								<label for="" class="block">座机号</label> 
								<input type="tel" class="msg-input" name="store_telephone" id="store_telephoneid" value="<?= $storetelephone ?>" data-message="座机号应为7-12位数字" data-regex="^[0-9\-]{0,13}$">
							</div>
							<div>
								<label for="" class="block">说明<span style="color:red">&nbsp;&nbsp;*</span></label> 
								<textarea class="msg-input" style="height:70px;" id="store_descid" name="store_desc" data-message="说明不能为空且为10-140个字" data-regex="^.{10,140}$" ><?=$storedesc?></textarea>
							</div> 
							<input type="hidden" class="msg-input" name="store_latitude" id="store_latitudeid" value="<?= $storelatitude ?>" data-message="请标注地图" data-regex="^.+$"> 
							<input type="hidden" class="msg-input" name="store_longitude" id="store_longitudeid" value="<?= $storelontitude ?>" data-message="请标注地图" data-regex="^.+$"> 
							<p class="tc msg-btn"> 
							<a href="javascript:;" id="save" class="btnGreen" onclick="submitform(this);">完成</a> 
							</p>
				</div>

				<div class="clr"></div> 
			</div> 
		</div> 
		<div class="sideBar"> 
			<div class="catalogList"> 
				<ul> 
					<li class="<?php if($_GET['module']==='customersettting'){ echo "selected";} ?>"> <a href="/customer/home.php?module=customersettting">修改密码</a> </li> 
					<li class="<?php if($_GET['module']==='editstorecover'){ echo "selected";} ?>"> <a href="/customer/home.php?module=editstorecover">修改饭店封面</a> </li>
					<li class="<?php if($_GET['module']==='editstoreinfo'){ echo "selected";} ?>"> <a href="/customer/home.php?module=editstoreinfo">修改饭店信息</a> </li>
				</ul> 
			</div> 
		</div> 
		<div class="clr"></div> 
	</div>
</div>

<script>


 function GetV(id){
 	return document.getElementById(id).value;
 }


 function submitform(obj){

 	if(!ValidateForm.validateForm('storeform')){
 		return;
 	}
 	//获得省市区的字符串组合
	//var provinceandcitystr = getSelectedValue('selProvance')+getSelectedValue('selCity')+getSelectedValue('selArea');

	var store_name = GetV('store_nameid');
	//var store_address = provinceandcitystr+GetV('store_addressid');
	var store_ownername = GetV('store_ownernameid');
	var store_mobilephone = GetV('store_mobilephoneid');
	var store_telephone = GetV('store_telephoneid');
	var store_desc = GetV('store_descid');
	var store_latitude = GetV('store_latitudeid');
	var store_longitude = GetV('store_longitudeid');

	var data = {
		store_name: store_name,
		//store_address: store_address,
		store_ownername: store_ownername,
		store_mobilephone: store_mobilephone,
		store_telephone: store_telephone,
		store_desc: store_desc,
		store_latitude: store_latitude,
		store_longitude: store_longitude
	}
	addClass(obj,'btnDisable');
	$.ajax({
	  type: "post",
	  url: "/customer/module/customersetting/updatestoreinfo.php",
	  data: data,
	  dataType: 'json',
	  success:function(data){
	  	if(data.status == 1){
	  		MessageTip.showTip(data.statusText);
	  	}else if (data.status == 0){
	  		MessageTip.showTip(data.statusText);
	  	}
	  	removeClass(obj,'btnDisable');
	  }
	})
}  

</script>


