/*
jquery-плагин
простой фоторедактор
*/ 
(function($){
	
	var styles={
		
		container:{
			'position':'relative','display':'inline-block','outline':'1px #765432 solid',
			},
		
		gray_bg:{
			'position':'absolute','top':'0px','left':'0px','width':'1px','height':'1px','background-color':'rgba(127,127,127,0.6)',
			},
		
		trans_fg:{
			'position':'absolute','top':'0px','left':'0px','width':'1px','height':'1px',
			},
		
		src_image:{
			'position':'absolute','top':'0px','left':'0px',
			},
		
		selection:{
			'position':'absolute','top':'0px','left':'0px','outline':'1px #FFFFFF solid','background-color':'rgba(255,255,255,0.3)',
			},
		
		sel_title:{
			'position':'absolute','max-width':'100%','height':'15px','color':'rgba(255,255,255,1)','bottom':'0px','left':'0px','margin':'1px','background-color':'rgba(0,0,0,0.8)',
			},
		
		sel_corner:{
			'position':'absolute','width':'10px','height':'10px','background-color':'rgba(255,255,255,0.6)',
			},
		
		sel_tl:{
			'top':'0px','left':'0px',
			},
		
		sel_br:{
			'bottom':'0px','right':'0px',
			},
		
		btn_ok:{
			'position':'absolute','top':'0px','right':'0px','padding':'5px','color':'rgba(255,255,255,1)','background-color':'rgba(0,0,0,0.8)','font-weight':'bold','cursor':'pointer',
			},
		
		sel_img:{
			'position':'absolute','top':'0px','left':'0px',
			},
		
		hidden:{
			'visibility':'hidden',
			},
		
		visible:{
			'visibility':'visible',
			},
		
		default:{
			
			},
		
		};
	
	var defaults={
		plugin:{
			name:'jqfePhotoArea',
			version:'0.1a',
			mod_date:'15/07/2014 20:53',
			},
		strings:{
			//press_me:'<p>Перетащите файлы на меня или нажмите для их выбора</p>',
			//error_no_filereader:'<p>Не поддерживается браузером</p>',
			},
		//action:'/',
		//name:'filename',
		callback:function(str){alert(str);}
		};
	
	var methods={
		
		init:function(params){
			
			var el,
					btn_ok,
					trans_fg,
					selection,
						sel_tl,
						sel_br,
						sel_title,
						sel_img,
					gray_bg,
					src_image;
			var dataURL;
			var callback;
			
			var options=$.extend({},defaults,params);
			this.data(defaults.plugin.name,options);
			callback=options.callback;
				
			// доступ к объекту через $(this)
			/*
			options={
				action
				name
				callback
				}
			*/
			el=$(this);
			el.data(defaults.plugin.name,options);
			el.html('').css(styles.container);
			
			gray_bg=$('<div/>',{
				
				}).css(styles.gray_bg).css(styles.hidden).appendTo(el);
			
			selection=$('<div/>',{
				
				}).css(styles.selection).css(styles.hidden).appendTo(el);
				sel_title=$('<span/>',{
					
					}).css(styles.sel_title).appendTo(selection);
				sel_tl=$('<div/>',{
					
					}).css(styles.sel_corner).css(styles.sel_tl).appendTo(selection);
				sel_br=$('<div/>',{
					
					}).css(styles.sel_corner).css(styles.sel_br).appendTo(selection);
			
			trans_fg=$('<div/>',{
				
				}).css(styles.trans_fg).appendTo(el);
			
			btn_ok=$('<span/>',{
					
					}).html('√ Применить').css(styles.btn_ok).css(styles.hidden).on('click',function(){
						//selection.remove();
						callback(dataURL);
						}).appendTo(el);
			
			src_image=new Image();
			src_image.src=options.image;
			el.prepend(src_image);
			src_image.onload=function(){
				try {
					
					gray_bg.css({width:src_image.width,height:src_image.height});
					trans_fg.css({width:src_image.width,height:src_image.height});
					trans_fg.click(function(e){
						if($(this).data(defaults.plugin.name+'clicked')) {
							
							$(this).data(defaults.plugin.name+'clicked',0);
							
							var x = e.pageX - $(this).offset().left;
							var y = e.pageY - $(this).offset().top;
							
							var sel_arr={
								left:$(this).data(defaults.plugin.name+'-x'),
								top:$(this).data(defaults.plugin.name+'-y'),
								width:(x-$(this).data(defaults.plugin.name+'-x')),
								height:(y-$(this).data(defaults.plugin.name+'-y')),
								};
							//if(options.ratio) {
							if (typeof(options.ratio) == "undefined") {
								
								} else {
									
									if(sel_arr.height>sel_arr.width) {
										sel_arr.width=Math.round(sel_arr.height*options.ratio);
										} else {
											sel_arr.height=Math.round(sel_arr.width/options.ratio);
											}
									if((sel_arr.width+sel_arr.left)>src_image.width) {
										sel_arr.width=src_image.width-sel_arr.left;
										sel_arr.height=Math.round(sel_arr.width/options.ratio);
										}
									if((sel_arr.height+sel_arr.top)>src_image.height) {
										sel_arr.height=src_image.height-sel_arr.top;
										sel_arr.width=Math.round(sel_arr.height*options.ratio);
										}
									
									}
							$(this).data(defaults.plugin.name+'selection',sel_arr);
							
							selection.css(sel_arr).css(styles.visible);
							btn_ok.css(styles.visible);
							gray_bg.css({width:src_image.width,height:src_image.height}).css(styles.visible);
							
							var canvas=document.createElement("canvas");
							canvas.setAttribute('width',sel_arr.width+'px');
							canvas.setAttribute('height',sel_arr.height+'px');
							var ctx = canvas.getContext('2d');
							ctx.drawImage(src_image,
								sel_arr.left, sel_arr.top, sel_arr.width, sel_arr.height,
								0, 0, sel_arr.width, sel_arr.height);
							
							sel_img=new Image();
							sel_img.src=canvas.toDataURL("image/png");
							sel_img.onload = function() {
								try {
									
									selection.append(sel_img);
									if (typeof(options.ratio) == "undefined") {
										sel_title.html(sel_arr.width+'x'+sel_arr.height);
										} else {
											sel_title.html('r='+options.ratio.toFixed(2)+'; '+sel_arr.width+'x'+sel_arr.height);
											}
									dataURL=canvas.toDataURL("image/png");
									//callback(canvas.toDataURL("image/png"));
									
									} catch (err) {
										alert(err.code);
										}
								};
							
							} else {
								
								$(this).data(defaults.plugin.name+'clicked',1);
								$(this).data(defaults.plugin.name+'selection',{});
								//sel_img = new Image();
								selection.find('img').remove();
								
								gray_bg.css(styles.hidden);
								selection.css(styles.hidden);
								btn_ok.css(styles.hidden);
								
								var x = e.pageX - $(this).offset().left;
								var y = e.pageY - $(this).offset().top;
								
								$(this).data(defaults.plugin.name+'-x',x);
								$(this).data(defaults.plugin.name+'-y',y);
								
								}
						});
					
					} catch (err) {
						alert(err.code);
						}
				};
				
			return this;
			}
		
		};
	
	$.fn.jqfePhotoArea=function(method){
		if(methods[method]) {
			return methods[method].apply(this,Array.prototype.slice.call(arguments,1));
			} else if(typeof method==='object' || !method) {
				return methods.init.apply(this,arguments);
				} else {
					$.error('Метод '+method+' в плагине не найден!');
					}
		};
	
})(jQuery);