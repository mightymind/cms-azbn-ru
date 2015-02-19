/*
Прослойка для работы с API CMS
*/

var cmsAPI={

config:{
	api_url:'/api/call/',
	app_key:'public',
	service:'online',
	method:'check',
	div_result_id:'#cmsAPIResult',
	},

call:function(params) {
	params.app_key=this.config.app_key;
	
	$.ajax({
		url: this.config.api_url,
		type: 'POST',
		dataType: 'json',
		data: params,
		success: function(resp) {
			cmsAPI.callbacks[resp.req.callback](resp);
			$('body').jqfeInfoMsg({html:resp.info.info_msg,showtime:5000});
			}
		});
	},

UI:{
	
	/*
	addItem2LinkingCardsList:function(id,img,title) {
		//$('body').jqfeInfoMsg({html:'',showtime:3000});
		},
	*/
	
	OnReady:{
		
		FancyboxConfig:function(){
			
			$('.fancybox-btn')
			.each(function(index){
				$(this).attr('href',$(this).attr('href')+'?.jpg');
				})
			.fancybox({
				//openEffect:'none',
				//closeEffect:'none',
				prevEffect:'none',
				nextEffect:'none',
				closeBtn:false,
				overlayShow : true, //затемнение основной страницы (фон) true/false
				overlayOpacity : 0.5, //прозрачность фона
				overlayColor : '#333333', //цвет фона
				titleShow : true, //вывод надписей под изображениями
				width : 560, //ширина окна
				height : 340,
				helpers:{
					title : {
						type : 'inside',
						},
					buttons: {
						//position : 'top',
						}
					},
				afterLoad:function() {
					//this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
					this.title = (this.title ? ' - ' + this.title : '');
					},
				});
			
		},
		
		FTSearchFilterOnClick:function(){
			
			$('.ftsearch-flt').on('click',function(event){
				$('.ftsearch-flt').removeClass('active');
				$(this).addClass('active');
				
				var flt=$(this).attr('data-flt');
				if(flt!='') {
					//.is(":visible")
					$('.ftsearch-block .ftsearch-item').each(function(index){
						if($(this).is(":visible") && !$(this).hasClass('ftsearch-item-'+flt)) {
							$(this).slideUp('fast');
						} else if($(this).is(":hidden") && $(this).hasClass('ftsearch-item-'+flt)) {
							$('.ftsearch-block .ftsearch-item-'+flt).slideDown('fast');
						} else {
							
						}
					});
				} else {
					$('.ftsearch-block .ftsearch-item:hidden').slideDown('fast');
				}
			});
			
		},
		
		FaqSessionControl:function(){
			
			$('input[name="faq_session_control"]').each(function(index){
				$(this).val($(this).parent().attr('data-faq_session_control'));
			});
			
		},
		
		FeedbackSessionControl:function(){
			
			$('input[name="feedback_session_control"]').each(function(index){
				$(this).val($(this).parent().attr('data-feedback_session_control'));
			});
			
		},
		
		LiveEditInit:function(){
			
			$('body').data('liveedit-enable',0).bind('keydown.liveedit',function(event){
				event.stopPropagation();
				if(event.ctrlKey && event.which==81) { // Ctrl + Q
					if(!$(this).data('liveedit-enable')) {
						$(this).data('liveedit-enable',1);
						$('[data-liveedit]').each(function(index){
							var el=$(this);
							var uid=el.attr('data-liveedit');
							el.addClass('liveedit-enable').prop('contenteditable',true).bind('blur.liveedit',function(event){
								
							}).bind('keydown.liveedit',function(event){//keyup keypress event.shiftKey и event.altKey
								event.stopPropagation();
								if(event.ctrlKey && event.which==83) {// Ctrl + S
									event.preventDefault();
									cmsAPI.call({service:'liveedit', method:'field', 'uid':uid, 'value':el.html(), callback:'LiveEditCallback'});
									el.trigger('blur.liveedit');
								}
								if(event.ctrlKey && event.which==90) {// Ctrl + Z
									event.preventDefault();
									el.trigger('blur.liveedit');
								}
								if(event.ctrlKey && event.which==73) {// Ctrl + I
									
								}
								if(event.ctrlKey && event.which==66) {// Ctrl + B
									
								}
								//console.log(event.which);
							});
						});
					} else {
						$(this).data('liveedit-enable',0);
						$('[data-liveedit]').unbind('blur.liveedit').unbind('keydown.liveedit').prop('contenteditable',false).removeClass('liveedit-enable');
					}
				}
			});
			
		},
		
	},
	
	},

callbacks:{
	
	CheckOnline:function(resp) {
		
		},
	
	ShowEntityList:function(resp) {
		var div = $(cmsAPI.config.div_result_id);
		div.html('');
		
		for(var i=0; i<resp.response.item_list.length; i++) {
			var item=resp.response.item_list[i];
			
			$('<div/>',{
				id:resp.req.prefix+'-'+resp.req.type+'-item-'+item.id,
				html:item.name
				}).appendTo(div);
			
			}
		
		},
	
	LiveEditCallback:function(resp) {
		
		},
		
	}

	}