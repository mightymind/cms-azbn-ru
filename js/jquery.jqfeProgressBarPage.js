// jquery-плагин-заготовка
(function($){
	
	var defaults={
		plugin:{
			name:'jqfeProgressBarPage',
			version:'0.1a',
			mod_date:'25/11/2014 16:13'
			},
		callback:function(){},
		showtime:6000
		};
	//var options;
	
	$.fn.jqfeProgressBarPage=function(params){
		
		var options=$.extend({},defaults,params);
		
		return this.each(function(){
			
			// тут код
			// доступ к объекту через $(this)
			
			//this.data(defaults.plugin.name,options);
			var el=$(this);
			//el.data(defaults.plugin.name,options);
			
			var pbar=$('<div/>', {
					css:{
						'outline': '1px solid blue',
						/*'width': '15px',*/
						'height': '100px',
						'position': 'fixed',
						'top': '10px',
						'right': '10px',
						},
					html:'',
					}).appendTo(el);
			
			var pline=$('<div/>', {
					css:{
						'width': '12px',
						'background': 'blue',
						'height': '0%',
						'margin': '0px 2px',
						},
					html:'',
					}).appendTo(pbar);
			
			$(window).on('load scroll resize',function(event){
				var max = document.body.scrollHeight - innerHeight;
				var percent = (pageYOffset / max) * 100;
				pline.css({
					'height': percent + '%',
					});
				});
			
			});
		};
	
})(jQuery);