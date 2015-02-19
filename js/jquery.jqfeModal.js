/*
jquery-плагин
ajax-загрузки файлов на сервер
*/ 
(function($){
	
	var defaults={
		plugin:{
			name:'jqfeModal',
			version:'0.2a',
			mod_date:'27/12/2013 12:14'
			},
		callback:function(){}
		};
	
	var methods={
		
		init:function(params){
			var options=$.extend({},defaults,params);
			
			//if(!this.data(defaults.plugin.name)) {
				this.data(defaults.plugin.name,options);
				
				var el=$(this);
				//var callback=options.callback;
				el.data(defaults.plugin.name,options);
				
				el.wrap('<div id="'+defaults.plugin.name+'-wrap_div" style="display:none;" ></div>');
				
				$('#'+defaults.plugin.name+'-modal_div').empty().remove();
				$('#'+defaults.plugin.name+'-black_div').empty().remove();
				
				var jqfe_modalclose_btn=$('<div/>', {
					id: defaults.plugin.name+'-modalclose_btn',
					css:{
						'float':'right',
						'clear':'both',
						'margin':'-35px -10px 5px 5px',
						'padding':'5px',
						'font-weight':'bold',
						'cursor':'pointer',
						},
					html:'&larr; Закрыть'
					});
				
				var jqfe_modal_div=$('<div/>', {
					id: defaults.plugin.name+'-modal_div',
					css:{
						'position':'absolute',
						'display':'none',
						'top':'0px',
						'left':'0px',
						'border':'1px #FFFFFF solid',
						'padding':'40px 30px 20px 30px',
						'margin':'0px 0px 20px 0px',
						'min-height':'300px',
						'width':'800px',
						'min-width':'240px',
						'z-index':'900',
						'background-color':'white',
						'transparent':'none',
						'-moz-box-shadow':'0px 0px 11px #000000',
						'-webkit-box-shadow':'0px 0px 11px #000000',
						'box-shadow':'0px 0px 11px #000000',
						}
					}).append(jqfe_modalclose_btn).append(el).appendTo($('body'));
				
				var jqfe_black_div=$('<div/>', {
					id: defaults.plugin.name+'-black_div',
					css:{
						'min-width':'100%',
						'min-height':'100%',
						'background-color':'rgba(0,0,0,0.6)',
						'position':'fixed',
						'display':'none',
						'top':'0px',
						'left':'0px',
						'margin':'0px',
						'padding':'0px',
						'z-index':'800',
						}
					}).appendTo($('body'));
				
				jqfe_modalclose_btn.bind('click.'+defaults.plugin.name,function(){
						$('#'+defaults.plugin.name+'-wrap_div').append(el);
						el.unwrap();
						
						jqfe_black_div.fadeOut('fast').empty().remove();
						jqfe_modal_div.fadeOut('fast').empty().remove();
						});
				
				jqfe_black_div.fadeIn('fast');
				jqfe_modal_div.css({position:'fixed'});
				var top_y=(($(window).height())/2+$(window).scrollTop()-(jqfe_modal_div.height()/2));
				if($(window).width()<800) {
					var width_=$(window).width()-20;
					var left_=10;
					} else {
						var width_=Math.floor($(window).width()*0.8);
						var left_=Math.floor($(window).width()*0.1);
						}
				if(top_y<40) {top_y=20;}
				jqfe_modal_div.css({
						width:width_+'px',
						left:left_+'px',
						top:top_y+'px'
						})
					.css({
						position:'absolute'
						})
					.fadeIn('fast');
				//}
				
			return this;
			},
		
		close:function() {
			var el=$(this);
			var options = el.data(defaults.plugin.name);
			
			$('#'+defaults.plugin.name+'-wrap_div').append(el);
			el.unwrap();
			
			jqfe_black_div.fadeOut('fast').empty().remove();
			jqfe_modal_div.fadeOut('fast').empty().remove();
			
			return this;
			}
		
		};
	
	$.fn.jqfeModal=function(method){
		if(methods[method]) {
			return methods[method].apply(this,Array.prototype.slice.call(arguments,1));
			} else if(typeof method==='object' || !method) {
				return methods.init.apply(this,arguments);
				} else {
					$.error('Метод '+method+' в плагине не найден!');
					}
		};
	
})(jQuery);