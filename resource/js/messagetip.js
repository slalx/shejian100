	 
MessageTip = {
	 showTip: function(sucmsg){
	 	var messagetip = document.getElementById('messagetipsuc');
	 	messagetip.firstChild.innerHTML = sucmsg;
	 	messagetip.style.display="block";
	 	window.setTimeout(MessageTip.hideTip,3000);
	 },
	 hideTip: function hideTip(){
	 	document.getElementById('messagetipsuc').style.display="none";
	 }
}