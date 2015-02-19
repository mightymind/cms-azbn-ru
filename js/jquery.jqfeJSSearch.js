// jquery-плагин-заготовка
(function($){
	
	var defaults={
		plugin:{
			name:'jqfeJSSearch',
			version:'0.1a',
			mod_date:'01/02/2015 00:24'
			},
		callback:function(){}
		};
	
	$.fn.jqfeJSSearch=function(params){
		
		var options=$.extend({},defaults,params);
		clb=options.callback;
		
		return this.each(function(){
			
			//$(this).data(defaults.plugin.name,options);
			
			$(this).find('.searched').removeClass();
			
			if (options.text == "" || options.text == " ") {
				
				
				
			} else {
				
				var exp = new RegExp('(' + options.text + ')', "ig");
				var counter = 0;
				var msg = '';
				
				$(this)
					.find('*')
					.contents()
					.each(function(index) {
						
						if (this.nodeType == 3) {
							
							if (exp.test(this.nodeValue)) {
								$(this).replaceWith(this.nodeValue.replace(exp,'<span class="searched">$1</span>'));
								counter++;
							}
							
						} else {
							
							if (this.nodeType == 1) {
								if (exp.test(this.innerHTML)) {
									
									var code = this.outerHTML;
									var s1 = code.slice(0, code.indexOf('>') + 1);
									var s2 = code.slice(code.indexOf('</'));
									var s3 = code.slice(code.indexOf('>') + 1, code.indexOf('</'));
									$(this).replaceWith(s1 + '<span class="searched">' + s3 + '</span>' + s2);
									counter++;
									
								}
							}
							
						}
						
					});
				
				if(counter>0) {
					msg='Найдено: '+counter;
				} else {
					msg='Ничего не найдено';
				}
				
				clb({
					msg:msg,
					count:counter,
					text:options.text,
					});
				
			}
			
			});
		};
	
})(jQuery);