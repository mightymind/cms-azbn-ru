/*
jquery-плагин
ajax-загрузки файлов на сервер
*/ 
(function($){
	
	var styles={
		base:{
			'display': 'block',
			'cursor': 'pointer',
			'color': '#555555',
			'font-size': '18px',
			'font-weight': 'bold',
			'text-align': 'center',
			'padding': '50px 0px',
			'margin': '0px auto',
			'border': '1px solid',
			'-webkit-border-radius': '7px',
			'-moz-border-radius': '7px',
			'border-radius': '7px',
			//'content': 'Перетащите файлы сюда или нажмите на меня для их выбора',
			},
		default:{
			'background-color':'#EEEEEE',
			'border-color':'#CCCCCC',
			},
		error:{
			'background-color':'#FFAAAA',
			'border-color':'#FF0000',
			},
		hover:{
			'background-color':'#DDDDDD',
			'border-color':'#AAAAAA',
			},
		drop:{
			'background-color':'#AAFFAA',
			'border-color':'#00FF00',
			},
		};
	
	var defaults={
		plugin:{
			name:'jqfeDropImgOptimizer',
			version:'0.2a',
			mod_date:'27/03/2014 10:29',
			},
		strings:{
			press_me:'<p>Перетащите файлы на меня или нажмите для их выбора</p>',
			error_no_filereader:'<p>Не поддерживается браузером</p>',
			},
		//action:'/',
		//name:'filename',
		callback:function(str){alert(str);}
		};
	
	var modifyAndUpload=function(el, file, options, event) {
		
		var reader = new FileReader();
		
		var callback = options.callback;
		
		if (!file.type.match(/image.*/)) {
			return true;
			}
		
		reader.onload = function(event) {
			
			var img = document.createElement("img");
			img.src = event.target.result;
			
			img.onload = function() {
				try {
					
					var real_w=img.width;
					var real_h=img.height;
					var w=1;
					var h=1;
					
					if(real_w>options.max_width || real_h>options.max_height) {
						
						var real_prop=real_w/real_h;
						var max_prop=options.max_width/options.max_height;
						
						if(real_prop>max_prop) {
							w=options.max_width;
							h=Math.round(w/real_prop);
							} else {
								h=options.max_height;
								w=Math.round(h*real_prop);
								}
						
						} else {
							
							w=real_w;
							h=real_h;
							
							}
					
					var canvas = document.createElement("canvas");
					canvas.setAttribute('width',w);
					canvas.setAttribute('height',h);
					var ctx = canvas.getContext('2d');
					ctx.drawImage(img, 0, 0, w, h);
					
					callback(canvas.toDataURL("image/png"));
					
					} catch (err) {
						console.error(err.code);
						}
				};
			
			};
		
		reader.onerror = function(event) {
			console.error('Error: '+event.target.error.code);
			};
		
		reader.readAsDataURL(file);
		
		};
	
	var selectFilesAndModify=function(el, files, options, event) {
		
		var reader = new FileReader();
		
		var callback = options.callback;
		
		$.each(files, function(i, file) {
			
			if (!file.type.match(/image.*/)) {
			return true;
			}
			
			modifyAndUpload(el, file, options, event)
		
			});
		
		}
	
	var methods={
		
		init:function(params){
			
			var options=$.extend({},defaults,params);
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
			el.data(defaults.plugin.name+'-counter',0);
			el.css(styles.base);
			el.html(defaults.strings.press_me);
			
			if (typeof(window.FileReader) == 'undefined') {
				
				el.html(defaults.strings.error_no_filereader);
				el.css(styles.error);
				
				}
			
			el[0].ondragover = function() {
				
				el.css(styles.hover);
				return false;
				
				};
			
			el[0].ondragleave = function() {
				
				el.css(styles.default);
				return false;
				
				};
			
			el[0].ondrop = function(event) {
				
				el.css(styles.drop);
				
				for (var i=0,f; f=event.dataTransfer.files[i]; i++) {
					
					var file = event.dataTransfer.files[i];
					modifyAndUpload(el, file, options, event);
					
					}
				
				return false;
				
				};
			
			el[0].onclick = function(event) {
				
				el.css(styles.drop);
				
				var uploadfile;
					uploadfile=$('<input/>', {
						name: options.name,
						type: 'file',
						multiple: 'multiple',
						css:{
							'display':'none'
							},
						id: defaults.plugin.name+'-uploadfile',
						}).appendTo($('body')).bind('change.'+defaults.plugin.name,function(){
							
							selectFilesAndModify(el, this.files, options, event);
							
							/*
							for (var i=0,f; f=this.files; i++) {
					
								var file = uploadfile.files[i];
								modifyAndUpload(el, file, options, event);
								
								}
							*/
							
							uploadfile.unbind('change.'+defaults.plugin.name);
							uploadfile.remove();
							
							});
					
				uploadfile.trigger('click.'+defaults.plugin.name);
				
				return false;
				
				};
				
			return this;
			}
		
		};
	
	$.fn.jqfeDropImgOptimizer=function(method){
		if(methods[method]) {
			return methods[method].apply(this,Array.prototype.slice.call(arguments,1));
			} else if(typeof method==='object' || !method) {
				return methods.init.apply(this,arguments);
				} else {
					$.error('Метод '+method+' в плагине не найден!');
					}
		};
	
})(jQuery);