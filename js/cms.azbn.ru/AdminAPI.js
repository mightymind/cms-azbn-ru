/*
Прослойка для работы с AdminAPI CMS
*/

var AdminAPI={

config:{
	api_url:'/api/admin/',
	app_key:'',
	service:'online',
	method:'check',
	div_result_id:'#AdminAPIResult',
	},

call:function(params) {
	params.app_key=this.config.app_key;
	//params.service=this.config.service;
	//params.method=this.config.method;
	
	$.ajax({
		url: this.config.api_url,
		type: 'POST',
		dataType: 'json',
		data: params,
		success: function(resp) {
			AdminAPI.callbacks[resp.req.callback](resp);
			$('body').jqfeInfoMsg({html:resp.info.info_msg,showtime:5000});
			}
		});
	},

UI:{
	
	//addItem2LinkingCardsList:function(item) {
	addItem2LinkingCardsList:function(id,img,title) {
		var item={
			id:id,
			img:img,
			title:title,
			};
		$('#card-div-'+item.id).empty().remove();
		var div=$('<div/>',{
			class:'thumbnail col-xs-3 col-sm-3 col-md-3 col-lg-3 card-item-div',
			id:'card-div-'+item.id
			});
		div.append('<input type="hidden" name="cards[]" value="'+item.id+'" />');
		div.append('<a class="pull-right absolute" href="#remove-card-'+item.id+'" onClick="$(\'#card-div-'+item.id+'\').empty().remove();" ><img class="icon" src="/img/cms.azbn.ru/delete.png" /></a>');
		div.append('<img class="img-rounded" src="'+item.img+'" />');
		div.append('<small>'+item.title+'</small>');
		
		$('#LinkingCardsList').append(div);
		$('body').jqfeInfoMsg({html:'Карточка <b>'+item.title+'</b> добавлена в список',showtime:3000});
		},
	
	/*
	loadOnlineLogActions:function() {
		AdminAPI.call({
			service:'online',
			method:'log_as_actions',
			callback:'ShowLogAsActions'
			});
	},
	*/
	
	},

callbacks:{
	
	CheckOnline:function(resp) {
		//alert(resp.info.info_msg);
		},
	
	ClearTable:function(resp) {
		
		},
	/*
	ShowLogAsActions:function(resp) {
		
	},
	*/
	
	ShowEntityList:function(resp) {
		var div = $(AdminAPI.config.div_result_id);
		div.html('');
		
		for(var i=0; i<resp.response.item_list.length; i++) {
			var item=resp.response.item_list[i];
			
			$('<div/>',{
				id:resp.req.prefix+'-'+resp.req.type+'-item-'+item.id,
				html:item.name
				}).appendTo(div);
			
			}
		
		},
	
	ShowEntityCatList:function(resp) {
		var div = $(AdminAPI.config.div_result_id);
		div.html('');
		
		for(var i=0; i<resp.response.item_list.length; i++) {
			var item=resp.response.item_list[i];
			
			$('<div/>',{
				id:resp.req.prefix+'-'+resp.req.type+'-cat-'+item.id,
				html:item.name
				}).appendTo(div);
			
			}
		
		},
	
	ChangeUserRightName:function(resp) {
		$('#userright-name-'+resp.req.id).html(resp.req.name);
		},
	
	CreateUserRight:function(resp) {
		location.href='/admin/all/userright/';
		},
	
	UserTaskChangeStatus:function(resp) {
		
		},
	
	ShowSearchResultAtIndex:function(resp) {
		var div = $('#Div4SearchResult');
		
		if(resp.response.item_list) {
			
			div.html('<hr />');
			
			for(var i=0; i<resp.response.item_list.length; i++) {
				var item=resp.response.item_list[i];
				
				var item_div=$('<div/>',{
					id:resp.req.item_type+'-div-'+item.id,
					class:'col-xs-12 col-sm-12 col-md-12 col-lg-12',
					html:''
					});
				var item_p=$('<p/>',{
					html:'<a href="/'+resp.req.item_type+'/view/'+item.id+'/" >'+item.title+'</a>'
					});
				item_p.appendTo(item_div);
				item_div.appendTo(div);
				
				}
			} else {
				
				div.html('');
				
				var item_div=$('<div/>',{
					class:'col-xs-12 col-sm-12 col-md-12 col-lg-12',
					html:'<hr /><p><b>Ничего не найдено. Попробуйте задать другие условия поиска.</b></p>'
					});
				div.append(item_div);
				
				}
		},
	
	ShowFTSearchResultAtIndex:function(resp) {
		var div = $('#Div4SearchResult');
		
		if(resp.response.item_list) {
			
			div.html('<hr />');
			
			for(var i=0; i<resp.response.item_list.length; i++) {
				var item=resp.response.item_list[i];
				
				var item_div=$('<div/>',{
					id:resp.req.item_type+'-div-'+item.id,
					class:'col-xs-12 col-sm-12 col-md-12 col-lg-12',
					html:''
					});
				html_str='<a href="/'+item.type+'/view/'+item.id+'/" >'+item.title+'</a>';
				var item_p=$('<p/>',{
					html:html_str,
					});
				item_p.appendTo(item_div);
				item_div.appendTo(div);
				
				}
			} else {
				
				div.html('');
				
				var item_div=$('<div/>',{
					class:'col-xs-12 col-sm-12 col-md-12 col-lg-12',
					html:'<hr /><p><b>Ничего не найдено. Попробуйте задать другие условия поиска.</b></p>'
					});
				div.append(item_div);
				
				}
		},
	
	ShowSearchResult4LinkingCards:function(resp) {
		var div = $('#Div4SearchResult');
		
		if(resp.response.item_list) {
			
			div.html('<hr />');
			
			for(var i=0; i<resp.response.item_list.length; i++) {
				var item=resp.response.item_list[i];
				
				var item_a=$('<a/>',{
					href:'#add2list',
					html:'<img class="icon" src="/img/cms.azbn.ru/add.png" />',
					onClick:"AdminAPI.UI.addItem2LinkingCardsList('"+item.id+"','"+item.img+"','"+item.title+"');"
					});
				var item_p=$('<p/>');
				item_p.append(item_a);
				item_p.append(' '+item.title);
				item_p.appendTo(div);
				
				}
			} else {
				
				div.html('<hr />');
				
				var item_p=$('<p/>',{
					html:'<b>Ничего не найдено. Попробуйте задать другие условия поиска.</b>'
					});
				div.append(item_p);
				
				}
		},
	
	DirListing:function(resp) {
		var div = $('.listing[data-path="'+resp.req.dir+'"]').eq(0);
		div.html('');
		
		if(resp.response.item_list) {
			
			for(var i=0; i<resp.response.item_list.length; i++) {
				var item=resp.response.item_list[i];
				
				if(item.is_dir) {
					var item_a=$('<a/>',{
						class:'dir-title',
						href:'#toggle:'+resp.req.dir+'/'+item.name,
						html:'<img class="icon" src="/img/cms.azbn.ru/dir.png" /> '+item.name,
						}).attr('data-path',resp.req.dir+'/'+item.name).on('click',function() {
							AdminAPI.call({service:'fileman', method:'listing', dir:$(this).attr('data-path'), callback:'DirListing'});
							});
					var item_l=$('<div/>',{
						class:'listing',
						html:'',
						}).attr('data-path',resp.req.dir+'/'+item.name);
					var item_div=$('<div/>',{
						class:'is-dir',
						html:'',
						}).append(item_a).append(item_l);
					} else if(item.is_file) {
						var item_a=$('<a/>',{
							class:'file-title',
							href:'#open:'+resp.req.dir+'/'+item.name,
							html:'<img class="icon" src="/img/cms.azbn.ru/file.png" /> '+item.name,
							}).attr('data-path',resp.req.dir+'/'+item.name).on('click',function() {
								//AdminAPI.call({service:'fileman', method:'listing', dir:$(this).attr('data-path'), callback:'DirListing'});
								window.open('/admin/edit_file/?file='+$(this).attr('data-path'));
								});
						
						var item_div=$('<div/>',{
							class:'is-file',
							html:'',
							}).append(item_a);
						}
				
				item_div.appendTo(div);
				
				}
			
			} else {
				
				div.html('');
				
				}
		
		},
	
	SaveFileResult:function(resp) {
		
		},
	
	GenURLFromTitle:function(resp) {
		var url=$('input[name="url"]');
		
		if(resp.response.item) {
			url.val(resp.response.item.url);
		}
		
		},
		
	}

	}