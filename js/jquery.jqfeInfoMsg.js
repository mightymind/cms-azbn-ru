// jquery-плагин-заготовка
(function($){
	
	var defaults={
		plugin:{
			name:'jqfeInfoMsg',
			version:'0.1a',
			mod_date:'19/03/2014 09:35'
			},
		callback:function(){},
		showtime:6000
		};
	//var options;
	
	$.fn.jqfeInfoMsg=function(params){
		
		var options=$.extend({},defaults,params);
		
		return this.each(function(){
			
			// тут код
			// доступ к объекту через $(this)
			
			var jqfe_info_div=$('<div/>', {
					css:{
						'display':'none',
						'position':'fixed',
						'top':'10px',
						'right':'10px',
						'border':'1px #FFFFFF solid',
						'padding':'12px',
						'min-width':'256px',
						'max-width':'500px',
						'z-index':'900',
						'background-color':'white',
						'transparent':'none',
						'-moz-box-shadow':'0px 0px 10px #FF0000',
						'-webkit-box-shadow':'0px 0px 10px #FF0000',
						'box-shadow':'0px 0px 10px #FF0000',
						'border-radius':'8px',
						'-moz-border-radius':'8px',
						'-webkit-border-radius':'8px'
						},
					html:options.html
					}).appendTo($('body'));
			$(jqfe_info_div).fadeIn(400);
			
			setTimeout(function(){
				$(jqfe_info_div).empty().remove();
				},options.showtime);
			
			});
		};
	
})(jQuery);