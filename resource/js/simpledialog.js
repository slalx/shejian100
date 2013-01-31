

function SimpleDialog(opt){
	this.opt = opt || {};
	this.init();
	
}
SimpleDialog.prototype = {
	constructor:SimpleDialog,
	init:function(){
		var dialogc = document.getElementById("dialogBoxC");
		if(!dialogc){
			this.append();
			this.eles = this.getEl();
			this.show();
			this.bind();
		}else{
			this.eles = this.getEl();
			this.show();
		}
		
	},
	bind:function(){
		var self = this;
		this.eles.dialogOK.onclick = function(){self.confirm();};
		this.eles.dialogClose.onclick = function(){self.close();};
		this.eles.dialogCancle.onclick = function(){self.cancel();};
		if(this.opt.aftershow){
			this.opt.aftershow();
		}
	},
	append:function(){
		var div = document.createElement('div');
		div.innerHTML = this.tpl();
		document.body.appendChild(div.firstChild);
	},
	tpl :function(){
		var title = this.opt.title,
		content = this.opt.content,
		width = this.opt.width || '342px',
		height = this.opt.height || '';
		var template = '<div class="dialogBox" id="dialogBoxC" style="display: none; ">'+ 
							'<div class="background"></div>'+ 
							'<div id="dialogBox" class="dialog" style="width: '+width+'; top: 49px; ">'+ 
								'<div id="dialogTitle" class="title">'+title+'</div>'+ 
								'<div id="dialogContent" class="content" style="width: auto;height:'+height+' ">'+ 
									content+
								'</div>'+ 
								'<div class="operation">'+  
									'<button id="dialogOK" class="btn btnGreen" style="">确定</button>'+ 
									'<button id="dialogCancle" class="btn btnGray">取消</button>'+  
									'<button id="dialogClose" class="btn btnGray" style="display:none;">关闭</button>'+ 
								'</div>'+ 
							'</div>'+
						'</div>';
			return template;
	},
	getEl:function(){
		return {
			dialogBoxC :document.getElementById('dialogBoxC'),
			dialogOK:document.getElementById('dialogOK'),
			dialogClose:document.getElementById('dialogClose'),
			dialogCancle:document.getElementById('dialogCancle')
		}
	},
	confirm:function(){
		this.opt.confirm();
		this.hide();
	},
	cancel:function(){
		this.hide();
		this.opt.cancel();
	},
	close:function(){
		this.hide();
	},
	hide:function(){
		this.eles.dialogBoxC.style.display = 'none';
	},
	show:function(){
		this.eles.dialogBoxC.style.display = 'block';
	}
}