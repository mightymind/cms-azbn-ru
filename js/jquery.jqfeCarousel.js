/*
jquery-плагин

небольшая заготовка для карусели
*/

(function($){
	
	var defaults={
		plugin:{
			name:'jqfeCarousel',
			version:'0.2a',
			mod_date:'26/12/2013 12:46'
			},
		count:3,
		//interval:3000,
		timer_id:0,
		callback:function(str){alert(str);}
		};
	
	var methods={
		
		init:function(params){
			var options=$.extend({},defaults,params);
			
			//if(!this.data(defaults.plugin.name)) {
				this.data(defaults.plugin.name,options);
				
				// доступ к объекту через $(this)
				var el=$(this);
				el.data(defaults.plugin.name,options);
				
				var children=$(this).children();
			
				children.hide();
				for (var i=0; i<options.count; i++) {
					children.eq(i).show();
					}
					
				//}
				
			return this;
			},
		
		last2first:function() {
			var el=$(this);
			var options = el.data(defaults.plugin.name);
			el.children(':visible').eq(-1).hide(0);
			el.children().eq(-1).insertBefore(el.children().eq(0)).fadeIn('fast');
			return this;
			},
		
		first2last:function() {
			var el=$(this);
			var options = el.data(defaults.plugin.name);
			el.children(':visible').eq(0).hide(0).insertAfter(el.children().eq(-1));
			el.children(':hidden').eq(0).fadeIn('fast');
			return this;
			},
		
		stop:function() {
			var el=$(this);
			var options = el.data(defaults.plugin.name);
			clearInterval(options.timer_id);
			return this;
			}
		
		};
	
	$.fn.jqfeCarousel=function(method){
		if(methods[method]) {
			return methods[method].apply(this,Array.prototype.slice.call(arguments,1));
			} else if(typeof method==='object' || !method) {
				return methods.init.apply(this,arguments);
				} else {
					$.error('Метод '+method+' в плагине не найден!');
					}
		};
	
})(jQuery);