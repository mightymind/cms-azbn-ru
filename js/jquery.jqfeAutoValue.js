// jquery-плагин-заготовка
(function($){
	
	var defaults={};
	//var options;
	
	$.fn.jqfeAutoValue=function(params){
		
		var options=$.extend({},defaults,params);
		
		return this.each(function(){
			
			// тут код
			// доступ к объекту через $(this)
			for (key in options.elements) {
				$(key).attr(options.elements[key]);
				}
			
			});
		};
	
})(jQuery);