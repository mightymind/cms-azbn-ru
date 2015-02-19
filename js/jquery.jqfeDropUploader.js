/*
jquery-плагин
ajax-загрузки файлов на сервер
*/ 
(function($){
	
	// Пилюля от слабоумия для Chrome, который портит файлы в процессе загрузки.
	if (!XMLHttpRequest.prototype.sendAsBinary) {
		XMLHttpRequest.prototype.sendAsBinary = function(datastr) {
			function byteValue(x) {
				return x.charCodeAt(0) & 0xff;
				}
			var ords = Array.prototype.map.call(datastr, byteValue);
			var ui8a = new Uint8Array(ords);
			this.send(ui8a.buffer);
			}
		}
	
	var styles={
		base:{
			'display': 'block',
			'cursor': 'pointer',
			'color': '#555555',
			'font-size': '18px',
			'font-weight': 'bold',
			'text-align': 'left',
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
			name:'jqfeDropUploader',
			version:'0.2a',
			mod_date:'27/03/2014 02:24'
			},
		strings:{
			press_me:'<center>Перетащите файлы на меня или нажмите для их выбора</center>',
			error_no_filereader:'<center>Не поддерживается браузером</center>',
			},
		action:'/',
		name:'filename',
		callback:function(str){alert(str);}
		};
	
	var uploadFile=function(el, file, name, action, callback) {
		
		var reader = new FileReader();
		
		reader.onload = function() {
			
			var xhr = new XMLHttpRequest();
			
			xhr.upload.addEventListener("progress", function(e) {
				if (e.lengthComputable) {
					/* вычисление процента загрузки */
					var percent = parseInt((e.loaded * 100) / e.total);
					
					}
				}, false);
			
			xhr.onreadystatechange = function () {
				if (this.readyState == 4) {
					
					if(this.status == 200) {
						/* окончание загрузки */
						
						var counter=el.data(defaults.plugin.name+'-counter');
						counter++;
						el.data(defaults.plugin.name+'-counter',counter);
						
						callback(file,this.responseText,counter);
						
						} else {
							/* ошибка */
							el.html('Произошла ошибка!');
							el.css(styles.error);
							
							}
					
					}
				};
			
			xhr.open("POST", action);
			var boundary = "xxxxxxxxx";
			xhr.setRequestHeader("Content-Type", "multipart/form-data, boundary="+boundary);
			xhr.setRequestHeader("Cache-Control", "no-cache");
			
			var body = "--" + boundary + "\r\n";
			body += "Content-Disposition: form-data; name='"+name+"'; filename='"+unescape(encodeURIComponent(file.name))+"'\r\n";
			body += "Content-Type: application/octet-stream\r\n\r\n";
			body += reader.result + "\r\n";
			body += "--" + boundary + "--";
			
			if(xhr.sendAsBinary) {
				// firefox
				xhr.sendAsBinary(body);
				} else {
					// chrome (спецификация W3C)
					xhr.send(body);
					}
			
			};
		
		reader.readAsBinaryString(file);
		
		};
	
	var uploadFilesFromInput=function(el, files, name, action, callback) {
		
		el.css(styles.drop);
		
		$.each(files, function(i, file) {
			
			uploadFile(el, file, name, action, callback);
		
			});
		
		return false;
		
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
					uploadFile(el, file, options.name, options.action, options.callback);
					
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
							
							uploadFilesFromInput(el, this.files, options.name, options.action, options.callback);
							
							uploadfile.unbind('change.'+defaults.plugin.name);
							uploadfile.remove();
							
							});
					
				uploadfile.trigger('click.'+defaults.plugin.name);
				
				return false;
				
				};
				
			return this;
			}
		
		};
	
	$.fn.jqfeDropUploader=function(method){
		if(methods[method]) {
			return methods[method].apply(this,Array.prototype.slice.call(arguments,1));
			} else if(typeof method==='object' || !method) {
				return methods.init.apply(this,arguments);
				} else {
					$.error('Метод '+method+' в плагине не найден!');
					}
		};
	
})(jQuery);