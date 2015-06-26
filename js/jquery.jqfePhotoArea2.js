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
			'position':'absolute','top':'0px','left':'0px','outline':'1px #FFFFFF solid','background-color':'rgba(255,255,255,0.3)','z-index':'99',
			},
		
		sel_title:{
			'position':'absolute','max-width':'100%','height':'15px','color':'rgba(255,255,255,1)','bottom':'0px','left':'0px','margin':'1px','background-color':'rgba(0,0,0,0.8)',
			},
		
		sel_corner:{
			'position':'absolute','width':'10px','height':'10px','background-color':'rgba(255,0,0,0.7)','z-index':'100','outline':'1px solid red',
			},
		
		sel_tl:{
			'top':'0','left':'0',
			},
		
		sel_br:{
			'bottom':'0','right':'0',
			},
		
		btn_ok:{
			'position':'absolute','top':'-29px','right':'0px','padding':'5px','color':'rgba(255,255,255,1)','background-color':'rgba(0,0,0,0.8)','font-weight':'bold','cursor':'pointer','font-size':'90%',
			},
		
		btn_preview:{
			'position':'absolute','top':'-29px','right':'85px','padding':'5px','color':'rgba(255,255,255,1)','background-color':'rgba(0,0,0,0.8)','font-weight':'bold','cursor':'pointer','font-size':'90%',
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
			name:'jqfePhotoArea2',
			version:'0.2a',
			mod_date:'18/02/2015 09:55',
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
			
			var vals = {
				
				cont_w : 1,
				cont_h : 1,
				cont_ratio : 1,
				calcContRatio : function(el) {
					this.cont_w = el.width();
					this.cont_h = el.height();
					this.cont_ratio = this.cont_w / this.cont_h;
					return this.cont_ratio;
				},
				
				imgcont_ratio : 1,
				calcImgContRatio : function(el, w) {
					this.imgcont_ratio = w / this.cont_w;
					return this.imgcont_ratio;
				},
				
			};
			
			var el,
				btn_ok, // кнопка сохранения
				btn_preview, // кнопка сохранения превью
				trans_fg, // блок для определения координат
				selection, // выделение
					sel_tl, // top-left
					sel_br, // bottom-right
					sel_title, // пояснение
					sel_img, // картинка в выделении
				gray_bg, // серый фон
				src_image;
			
			var dataURL;
			var callback;
			var callback_preview;
			var rebuildSelection;
			
			var src_image_w;
			var src_image_h;
			
			var options=$.extend({},defaults,params);
			callback=options.callback;
			callback_preview=options.callback_preview;
			options.ratio=options.width/options.height;
				
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
				
				}).css(styles.selection).css(styles.hidden).appendTo(el).draggable({
						start: function() {},
						drag: function() {
							
							selection.find('img').remove();
							
						},
						stop: function() {
							
							rebuildSelection(trans_fg, {
								left:selection.position().left,
								top:selection.position().top,
								width:selection.width(),
								height:selection.height(),
								});
							
						},
						});
				sel_title=$('<span/>',{
					
					}).css(styles.sel_title).appendTo(selection);
				sel_tl=$('<div/>',{
					
					}).css(styles.sel_corner).css(styles.sel_tl).appendTo(selection).draggable({
						start: function() {},
						drag: function() {},
						stop: function() {
							
							var pos = $(this).position();
							var spos = selection.position();
							
							selection.css({
								left : spos.left + (pos.left),
								top : spos.top + (pos.top),
								width : selection.width() - (pos.left),
								height : selection.height() - (pos.top),
							});
							
							rebuildSelection(trans_fg, {
								left:selection.position().left,
								top:selection.position().top,
								width:selection.width(),
								height:selection.height(),
								});
							
							//$(this).css({left:0,top:0});
							
						},
						});
				sel_br=$('<div/>',{
					
					}).css(styles.sel_corner).css(styles.sel_br).appendTo(selection).draggable({
						start: function() {
							
							var pos = $(this).position();
							$(this).data(defaults.plugin.name+'-x', pos.left + $(this).width());
							$(this).data(defaults.plugin.name+'-y', pos.top + $(this).height());
							
						},
						drag: function() {},
						stop: function() {
							
							var pos = $(this).position();
							var spos = selection.position();
							
							pos.right = pos.left + $(this).width() - $(this).data(defaults.plugin.name+'-x');// + $(this).width();
							pos.bottom = pos.top + $(this).height() - $(this).data(defaults.plugin.name+'-y');// + $(this).height();
							
							selection.css({
								left : spos.left,
								top : spos.top,
								width : selection.width() + (pos.right),
								height : selection.height() + (pos.bottom),
							});
							
							rebuildSelection(trans_fg, {
								left:selection.position().left,
								top:selection.position().top,
								width:selection.width(),
								height:selection.height(),
								});
							
							//$(this).css({left:'',top:''}).css(styles.sel_br);
							
						},
						});
			
			trans_fg=$('<div/>',{
				
				}).css(styles.trans_fg).appendTo(el);
			
			btn_ok=$('<span/>',{
					
					}).html('√ Картинка').css(styles.btn_ok).css(styles.hidden).on('click',function(){
						//selection.remove();
						callback(dataURL);
						}).appendTo(el);
			
			btn_preview=$('<span/>',{
					
					}).html('√ Превью').css(styles.btn_preview).css(styles.hidden).on('click',function(){
						//selection.remove();
						callback_preview(dataURL);
						}).appendTo(el);
			
			src_image=new Image();
			src_image.src=options.image;
			
			rebuildSelection = function(el, sel_arr) {
				
				var ic_r=el.data(defaults.plugin.name+'-ratio2img');
				//alert(JSON.stringify(sel_arr));
				
				if (!options.in_ratio) {
					
				} else {
				
					if(sel_arr.height>sel_arr.width) {
						sel_arr.width=Math.round(sel_arr.height*options.ratio);
					} else {
						sel_arr.height=Math.round(sel_arr.width/options.ratio);
					}
					if((sel_arr.width+sel_arr.left)>el.width()) {
						sel_arr.width=el.width()-sel_arr.left;
						sel_arr.height=Math.round(sel_arr.width/options.ratio);
					}
					if((sel_arr.height+sel_arr.top)>el.height()) {
						sel_arr.height=el.height()-sel_arr.top;
						sel_arr.width=Math.round(sel_arr.height*options.ratio);
					}
				
				}
				
				selection.css(sel_arr).css(styles.visible);
				sel_tl.css({left:0,top:0}).css(styles.sel_tl);
				sel_br.css({left:'',top:''}).css(styles.sel_br);
				btn_ok.css(styles.visible);
				//btn_preview.css(styles.visible);
				btn_preview.css(styles.hidden);
				gray_bg.css({width:el.width(),height:el.height()}).css(styles.visible);
				
				var canvas=document.createElement("canvas");
				
				var cw, ch;
				if(options.in_size) {
					cw = options.width;
					ch = options.height;
				} else {
					cw = parseInt(ic_r * sel_arr.width);
					ch = parseInt(ic_r * sel_arr.height);
				}
				
				canvas.setAttribute('width', cw+'px');
				canvas.setAttribute('height', ch+'px');
				var ctx = canvas.getContext('2d');
				ctx.drawImage(
					src_image,
					parseInt(sel_arr.left * ic_r), parseInt(sel_arr.top * ic_r),
					parseInt(sel_arr.width * ic_r), parseInt(sel_arr.height * ic_r),
					0, 0,
					cw, ch
				);
				
				selection.find('img').remove();
				
				sel_img=new Image();
				sel_img.src=canvas.toDataURL("image/png");
				
				sel_img.onload = function() {
					try {
						
						dataURL=canvas.toDataURL("image/png");
						
						selection.append(sel_img);
						$(sel_img).css({width:sel_arr.width, height:sel_arr.height});
						if (typeof(options.ratio) == "undefined") {
							sel_title.html(cw+'x'+ch);
						} else {
							sel_title.html('r='+options.ratio.toFixed(2)+'; '+cw+'x'+ch);
						}
					
					} catch (err) {
						alert(err.code);
					}
				};
			
			}
			
			src_image.onload=function(){
				
				try {
					
					src_image_w=src_image.width;
					src_image_h=src_image.height;
					
					el.prepend(src_image);
					
					vals.calcContRatio(el);
					var ic_r = vals.calcImgContRatio(el, src_image_w);
					trans_fg.data(defaults.plugin.name+'-ratio2img', ic_r);
					
					gray_bg.css({width:el.width(),height:el.height()});
					trans_fg.css({width:el.width(),height:el.height()});
					
					var clicked={
						first:0,
						x:0,
						y:0,
					};
					
					trans_fg.click(function(e){
						
						if(clicked.first) {
							
							clicked.first=0;
							
							var x = e.pageX - $(this).offset().left;
							var y = e.pageY - $(this).offset().top;
							
							var sel_arr={
								left:clicked.x,
								top:clicked.y,
								width:(x-clicked.x),
								height:(y-clicked.y),
								};
							
							rebuildSelection(trans_fg, sel_arr);
							
							} else {
								
								//$(this).data(defaults.plugin.name+'clicked',1);
								clicked.first=1;
								
								selection.find('img').remove();
								
								gray_bg.css(styles.hidden);
								selection.css(styles.hidden);
								btn_ok.css(styles.hidden);
								btn_preview.css(styles.hidden);
								
								var x = e.pageX - $(this).offset().left;
								var y = e.pageY - $(this).offset().top;
								
								//$(this).data(defaults.plugin.name+'-x',x);
								//$(this).data(defaults.plugin.name+'-y',y);
								clicked.x = x;
								clicked.y = y;
								
								}
						
						});
					
					} catch (err) {
						alert(err.code);
						}
				};
				
			return this;
			}
		
		};
	
	$.fn.jqfePhotoArea2=function(method){
		if(methods[method]) {
			return methods[method].apply(this,Array.prototype.slice.call(arguments,1));
			} else if(typeof method==='object' || !method) {
				return methods.init.apply(this,arguments);
				} else {
					$.error('Метод '+method+' в плагине не найден!');
					}
		};
	
})(jQuery);