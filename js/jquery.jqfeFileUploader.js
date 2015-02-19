/*
jquery-плагин
ajax-загрузки файлов на сервер
*/ 
(function($){
	
	var defaults={
		plugin:{
			name:'jqfeFileUploader',
			version:'0.2a',
			mod_date:'25/12/2013 14:09'
			},
		action:'/',
		name:'filename',
		callback:function(str){alert(str);}
		};
	
	var methods={
		
		init:function(params){
			var options=$.extend({},defaults,params);
			
			//if(!this.data(defaults.plugin.name)) {
				this.data(defaults.plugin.name,options);
				
				// доступ к объекту через $(this)
				/*
				options={
					action
					name
					callback
					}
				*/
				var el=$(this);
				el.data(defaults.plugin.name,options);
				
				var callback=options.callback;
				
				el.unbind('click.'+defaults.plugin.name);
				el.bind('click.'+defaults.plugin.name,function(){
					
					var uploadform=$('<form/>', {
						name: defaults.plugin.name+'-uploadform',
						id: defaults.plugin.name+'-uploadform',
						enctype: 'multipart/form-data',
						method: 'POST',
						css:{
							display:'none'
							},
						action: options.action,
						target: defaults.plugin.name+'-uploadiframe',
						}).insertAfter(el);
					var uploadfile=$('<input/>', {
						name: options.name,
						type: 'file',
						id: defaults.plugin.name+'-uploadfile',
						}).appendTo(uploadform).bind('change.'+defaults.plugin.name,function(){
						//}).appendTo(uploadform).bind('input',function(){
							var uploadiframe=$('<iframe/>', {
						name: defaults.plugin.name+'-uploadiframe',
						id:   defaults.plugin.name+'-uploadiframe',
						src:  'about:blank',
						css:{
							display:'none'
							},
						}).insertAfter(uploadform).bind('load',function(){
							callback(uploadiframe.contents().find('body').eq(0).html());
							uploadfile.unbind('change.'+defaults.plugin.name);
							uploadfile.remove();
							uploadform.remove();
							uploadiframe.remove();
							});
							
							uploadform.submit();
							});
					
					uploadfile.trigger('click.'+defaults.plugin.name);
					
					});
				
				//}
				
			return this
			}
		
		};
	
	$.fn.jqfeFileUploader=function(method){
		if(methods[method]) {
			return methods[method].apply(this,Array.prototype.slice.call(arguments,1));
			} else if(typeof method==='object' || !method) {
				return methods.init.apply(this,arguments);
				} else {
					$.error('Метод '+method+' в плагине не найден!');
					}
		};
	
})(jQuery);