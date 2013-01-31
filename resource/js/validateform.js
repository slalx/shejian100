 
var ValidateForm = {

	 validateForm: function(formid){
	 	var formobj = document.getElementById(formid);
	 	var inputs = ValidateForm.getElementsByClassName('msg-input',formobj,'*');
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
	 	window.setTimeout(ValidateForm.hideTip,3000);
	 },
	 hideTip: function hideTip(){
	 	document.getElementById('messagetip').style.display="none";
	 },
	 getElementsByClassName : function (classname, parent, nodename) {
	    var s = (parent || document).getElementsByTagName(nodename || "*");
	    return function () {
	        var a = [];
	        for (var i = 0, j = s.length; i < j; i++) {
	            if (!s[i].className) continue;
	            var name = " " + s[i].className + " ";
	            if (name.indexOf(" " + classname + " ") != -1) {
	                a.push(s[i]);
	            }
	        }
	        return a;
	    } ();
	}

}
