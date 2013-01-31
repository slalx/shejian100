 
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
	 getElementsByClassName : function (searchClass, node,tag) {
	  if(document.getElementsByClassName){
	    var nodes =  (node || document).getElementsByClassName(searchClass),result = [];
	      for(var i=0 ;node = nodes[i++];){
	        if(tag !== "*" && node.tagName === tag.toUpperCase()){
	          result.push(node)
	        }else{
	          result.push(node)
	        }
	      }
	      return result
	    }else{
	      node = node || document;
	      tag = tag || "*";
	      var classes = searchClass.split(" "),
	      elements = (tag === "*" && node.all)? node.all : node.getElementsByTagName(tag),
	      patterns = [],
	      current,
	      match;
	      var i = classes.length;
	      while(--i >= 0){
	        patterns.push(new RegExp("(^|\\s)" + classes[i] + "(\\s|$)"));
	      }
	      var j = elements.length;
	      while(--j >= 0){
	        current = elements[j];
	        match = false;
	        for(var k=0, kl=patterns.length; k<kl; k++){
	          match = patterns[k].test(current.className);
	          if (!match)  break;
	        }
	        if (match)  result.push(current);
	      }
	      return result;
	    }
  	}

}
