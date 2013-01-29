 
var ValidateForm = {

	 validateForm: function(formid){
	 	var formobj = document.getElementById(formid);
	 	var inputs = formobj.getElementsByClassName('msg-input');
	 	for(var i=0,l=inputs.length; i<l; i++){
	 		var inputobj = inputs[i];
	 		var regex = inputobj.getAttribute('data-regex');
	 		if(regex!=null){
	 			var pattern = new RegExp(regex);
	 			if(!pattern.test(inputobj.value)){
	 				ValidateForm.showTip(inputobj.getAttribute("data-message"));
	 				return false;
	 			}
	 		}
	 	}
	 	return true;
	 },
	 showTip: function(errmsg){
	 	var messagetip = document.getElementById('messagetip');
	 	messagetip.firstChild.innerHTML = errmsg;
	 	messagetip.style.display="block";
	 	window.setTimeout(validateForm.hideTip,3000);
	 },
	 hideTip: function hideTip(){
	 	document.getElementById('messagetip').style.display="none";
	 }

}
