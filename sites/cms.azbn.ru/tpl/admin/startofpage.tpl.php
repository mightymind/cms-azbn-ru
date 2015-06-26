<?
// CMS Azbn.ru Публичная версия

?><!DOCTYPE html>
<html>
	<head>
		
		<meta HTTP-EQUIV="Cache-Control" content="no-cache" />
		<meta name="viewport" content="width=1280">

		<title>Администрирование - CMS Azbn.ru</title>
	
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link id="page_favicon" href="/img/cms.azbn.ru/favicon.png" rel="icon" type="image/x-icon" />
		
		<link href="/css/bs3/bootstrap.min.css" rel="stylesheet">
		
		<link href="/css/cms.azbn.ru/base.css?v=<?=$this->FE->date;?>" rel="stylesheet">
		<link href="/css/cms.azbn.ru/admin.css?v=<?=$this->FE->date;?>" rel="stylesheet">
		
		<script src="http://yandex.st/jquery/2.1.3/jquery.min.js"></script>
		<script>
		if(typeof window.jQuery === 'undefined') {
			document.write(
				unescape("%3Cscript src='/js/jquery.min.js' type='text/javascript'%3E%3C/script%3E")
				);
			}
		</script>
		<script src="/js/bs3/bootstrap.min.js"></script>
		
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		
		<!-- <script src="/js/jquery.jqfeFileUploader.js"></script> for delete -->
		<script src="/js/jquery.jqfeModal.js"></script>
		<script src="/js/jquery.jqfeInfoMsg.js"></script>
		<!-- <script src="/js/jquery.jqfeDropImgOptimizer.js"></script> for delete -->
		<script src="/js/jquery.jqfeDropImgOptimizer2.js"></script>
		<script src="/js/jquery.jqfeDropUploader.js"></script>
		<script src="/js/jquery.jqfeDropImgUploader.js"></script>
		<!-- <script src="/js/jquery.jqfePhotoArea.js"></script> for delete -->
		<script src="/js/jquery.jqfePhotoArea2.js"></script>
		<script src="/js/jquery.maskedinput.min.js"></script>
		
		<script src="/js/cms.azbn.ru/AdminAPI.js"></script>
		
		<script>
			
			$(document).ready(function() {
				
				/*
				AdminAPI.call({
					service:'online',
					method:'check',
					callback:'CheckOnline'
					});
				*/
				AdminAPI.config.app_key='<?=$this->FE->config['admin_app_key'];?>';
				
				$('.datepicker').datepicker({'firstDay':1});
				
				$('.maskedinput-time').mask("99:99:99");
				
				$('a.confirm-delete').each(function(i){
					$(this).attr({
						'data-href':$(this).attr('href'),
						'href':'#'+$(this).attr('href'),
						});
					}).bind('click',function(){
						if(confirm("Вы действительно хотите удалить запись?")) {
							location.href=$(this).attr('data-href');
							}
						});
				
				$('a.userright-btn-select').on('click',function(){
					$('table.userright-as-table').find('input[type=checkbox]').prop('checked', true);
					});
				$('a.userright-btn-unselect').on('click',function(){
					$('table.userright-as-table').find('input[type=checkbox]').prop('checked', false);
					});
				
				//if(typeof keys[event.keyCode] !== 'undefined'){
				
			});
		</script>

<?
$this->FE->PluginMng->event('admin:viewer:head:after', $param);
?>

	</head>
<body>

<div class="container"><!-- container-fluid -->
	
	<!-- Заголовок документа -->
	
	
	<div class="clear20" ></div>
	
	<div class="row">
		
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
			
			<ul class="list-inline">
				
				<li>
					<div class="btn-group" role="group">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							<img class="icon" src="/img/cms.azbn.ru/cms-azbn-ru-icon.png" /> CMS Azbn.ru <span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu">
							
							<li><a href="/" class="" target="_blank" >Главная сайта</a></li>
							<li><a href="/admin/page/index/" class="" >Администрирование</a></li>
							<li class="divider"></li>
							<li><a href="/admin/page/information/" class="" >Информация о CMS</a></li>
							<li><a href="http://azbn.ru/" class="" target="_blank" >Сайт автора CMS</a></li>
							
							<li class="divider"></li>
							<li><a href="/login/off/" ><img class="icon" src="/img/cms.azbn.ru/login_off.png" /> Выйти</a></li>
							
						</ul>
					</div>
				</li>
				
				<li>
					<div class="btn-group" role="group">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							<img class="icon" src="/img/cms.azbn.ru/content_menu.png" /> Контент <span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu">
							<!--
							<li class="divider"></li>
							<li><a href="#">Separated link</a></li>
							-->
							
							<?
							if($_SESSION['user']['right']['access_page']) {
							?>
							<li><a href="/admin/all/page/" ><img class="icon" src="/img/cms.azbn.ru/page.png" /> Страницы</a></li>
							<?
							}
							?>
							
							<?
							if($_SESSION['user']['right']['access_post']) {
							?>
							<li><a href="/admin/all/post/" ><img class="icon" src="/img/cms.azbn.ru/post.png" /> Посты</a></li>
							<?
							}
							?>
							
							<?
							if($_SESSION['user']['right']['access_news']) {
							?>
							<li><a href="/admin/all/news/" ><img class="icon" src="/img/cms.azbn.ru/news.png" /> Новости</a></li>
							<?
							}
							?>
							
							<?
							if($_SESSION['user']['right']['access_geopoint']) {
							?>
							<li><a href="/admin/all/geopoint/" ><img class="icon" src="/img/cms.azbn.ru/geopoint.png" /> Геометки</a></li>
							<?
							}
							?>
							
							<?
							if($_SESSION['user']['right']['access_product']) {
							?>
							<li><a href="/admin/all/product/" ><img class="icon" src="/img/cms.azbn.ru/product.png" /> Товары</a></li>
							<?
							}
							?>
							
							<?
							if($_SESSION['user']['right']['access_gallery']) {
							?>
							<li><a href="/admin/all/gallery/" ><img class="icon" src="/img/cms.azbn.ru/gallery.png" /> Галерея</a></li>
							<?
							}
							?>
							
							<?
							if($_SESSION['user']['right']['access_calendar']) {
							?>
							<li><a href="/admin/all/calendar/" ><img class="icon" src="/img/cms.azbn.ru/calendar.png" /> События календаря</a></li>
							<?
							}
							?>
							
							<?
							if($_SESSION['user']['right']['change_banner']) {
							?>
							<li><a href="/admin/all/banner/" ><img class="icon" src="/img/cms.azbn.ru/banner.png" /> Баннеры</a></li>
							<?
							}
							?>
							
							<?
							$param['mdl']['menu_entityitem_list']='admin/menu_entityitem_list';
							$this->FE->Viewer->module('menu_entityitem_list',$param);
							?>
							
							
							
							
							<li class="divider" ></li>
							
							
							
							
							
							<?
							if($_SESSION['user']['right']['change_pagecat_edit']) {
							?>
							<li><a href="/admin/all/pagecat/" ><img class="icon" src="/img/cms.azbn.ru/page.png" /> Разделы страниц</a></li>
							<?
							}
							?>
							
							<?
							if($_SESSION['user']['right']['change_postcat_edit']) {
							?>
							<li><a href="/admin/all/postcat/" ><img class="icon" src="/img/cms.azbn.ru/post.png" /> Разделы постов</a></li>
							<?
							}
							?>
							
							<?
							if($_SESSION['user']['right']['change_newscat_edit']) {
							?>
							<li><a href="/admin/all/newscat/" ><img class="icon" src="/img/cms.azbn.ru/news.png" /> Разделы новостей</a></li>
							<?
							}
							?>
							
							<?
							if($_SESSION['user']['right']['change_geopointcat_edit']) {
							?>
							<li><a href="/admin/all/geopointcat/" ><img class="icon" src="/img/cms.azbn.ru/geopoint.png" /> Разделы геометок</a></li>
							<?
							}
							?>
							
							<?
							if($_SESSION['user']['right']['change_productcat_edit']) {
							?>
							<li><a href="/admin/all/productcat/" ><img class="icon" src="/img/cms.azbn.ru/product.png" /> Разделы товаров</a></li>
							<?
							}
							?>
							
							<?
							if($_SESSION['user']['right']['change_bannercat']) {
							?>
							<li><a href="/admin/all/bannercat/" ><img class="icon" src="/img/cms.azbn.ru/banner.png" /> Позиции баннеров</a></li>
							<?
							}
							?>
							
							<?
							$param['mdl']['menu_entitycat_list']='admin/menu_entitycat_list';
							$this->FE->Viewer->module('menu_entitycat_list',$param);
							?>
							
						</ul>
					</div>
				</li>
				
				<li>
					<div class="btn-group" role="group">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							<img class="icon" src="/img/cms.azbn.ru/plugin.png" /> Плагины <span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu">
							
							<?
							$this->FE->PluginMng->event('admin:viewer:menu_plugin_list', $param);
							?>
							
						</ul>
					</div>
				</li>
				
				<li>
					<div class="btn-group" role="group">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							<img class="icon" src="/img/cms.azbn.ru/profile_menu.png" /> Пользовательское <span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu">
							
							<?
							if($_SESSION['user']['right']['access_profile']) {
							?>
							<li><a href="/admin/all/profile/" ><img class="icon" src="/img/cms.azbn.ru/profile.png" /> Список пользователей</a></li>
							<?
							}
							?>
							
							<?
							if($_SESSION['user']['right']['access_order']) {
							?>
							<li><a href="/admin/all/order/" ><img class="icon" src="/img/cms.azbn.ru/order.png" /> Заказы</a></li>
							<?
							}
							?>
							
							<?
							if($_SESSION['user']['right']['access_feedback']) {
							?>
							<li><a href="/admin/all/feedback/" ><img class="icon" src="/img/cms.azbn.ru/feedback.png" /> Обратная связь</a></li>
							<?
							}
							?>
									
							<?
							if($_SESSION['user']['right']['access_faq']) {
							?>
							<li><a href="/admin/all/faq/" ><img class="icon" src="/img/cms.azbn.ru/faq.png" /> FAQ</a></li>
							<?
							}
							?>
							
						</ul>
					</div>
				</li>
				
				<li>
					<div class="btn-group" role="group">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							<img class="icon" src="/img/cms.azbn.ru/usertask.png" /> Задания <span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu">
							
							<?
							if($_SESSION['user']['right']['access_usertask']) {
							?>
							<li><a href="/admin/all/usertask/" >Все задания</a></li>
							<li class="divider"></li>
							<li><a href="/admin/all/usertask/?user2=<?=$_SESSION['user']['id'];?>&status=0,2">Текущие задания</a></li>
							<li><a href="/admin/all/usertask/?user2=<?=$_SESSION['user']['id'];?>&status=3">Выполненные задания</a></li>
							<li><a href="/admin/all/usertask/?user2=<?=$_SESSION['user']['id'];?>&status=1">Не могу выполнить</a></li>
							<li class="divider"></li>
							<li><a href="/admin/all/usertask/?user=<?=$_SESSION['user']['id'];?>&status=0,2">Невыполненные мои задания</a></li>
							<li><a href="/admin/all/usertask/?user=<?=$_SESSION['user']['id'];?>&status=3">Мои выполненные задания</a></li>
							<li><a href="/admin/all/usertask/?user=<?=$_SESSION['user']['id'];?>&status=1">Не смогли выполнить</a></li>
							<?
							}
							?>
							
						</ul>
					</div>
				</li>
				
				<li>
					<div class="btn-group" role="group">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							<img class="icon" src="/img/cms.azbn.ru/admin_menu.png" /> Администрирование <span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu">
							
							<?
							if($_SESSION['user']['right']['access_filter']) {
							?>
							<li><a href="/admin/all/filter/" ><img class="icon" src="/img/cms.azbn.ru/filter.png" /> Фильтры информации</a></li>
							<?
							}
							?>
							
							<?
							if($_SESSION['user']['right']['change_alias']) {
							?>
							<li><a href="/admin/all/alias/" ><img class="icon" src="/img/cms.azbn.ru/alias.png" /> Перенаправления</a></li>
							<?
							}
							?>
							
							<?
							if($_SESSION['user']['right']['change_seo']) {
							?>
							<li><a href="/admin/all/seo/" ><img class="icon" src="/img/cms.azbn.ru/seo.png" /> SEO-настройки</a></li>
							<?
							}
							?>
							
							
							<?
							if($_SESSION['user']['right']['access_uplfile']) {
							?>
							<li><a href="/admin/all/uplfile/" ><img class="icon" src="/img/cms.azbn.ru/uplfile.png" /> Загруженные файлы</a></li>
							<?
							}
							?>
							
							<?
							if($_SESSION['user']['right']['access_plugin']) {
							?>
							<li><a href="/admin/all/plugin/" ><img class="icon" src="/img/cms.azbn.ru/plugin.png" /> Плагины</a></li>
							<?
							}
							?>
							
							
							<li class="divider"></li>
							
							<?
							if($_SESSION['user']['right']['access_fileman']) {
							?>
							<li><a href="/admin/page/fileman/" ><img class="icon" src="/img/cms.azbn.ru/fileman.png" /> Файловый менеджер</a></li>
							<?
							}
							?>
							
							<?
							if($_SESSION['user']['right']['change_user']) {
							?>
							<li><a href="/admin/all/user/" ><img class="icon" src="/img/cms.azbn.ru/user.png" /> Администраторы</a></li>
							<?
							}
							?>
							
							<?
							if($_SESSION['user']['right']['access_entity']) {
							?>
							<li><a href="/admin/all/entity/" ><img class="icon" src="/img/cms.azbn.ru/entity.png" /> Дополнительные сущности</a></li>
							<?
							}
							?>
							
							<?
							if($_SESSION['user']['right']['view_log']) {
							?>
							<li><a href="/admin/all/log/" ><img class="icon" src="/img/cms.azbn.ru/log.png" /> Просмотр логов</a></li>
							<?
							}
							?>
							
							<?
							if($_SESSION['user']['right']['change_apiapp']) {
							?>
							<li><a href="/admin/all/apiapp/" ><img class="icon" src="/img/cms.azbn.ru/apiapp.png" /> Приложения API</a></li>
							<?
							}
							?>
							
							<?
							if($_SESSION['user']['right']['change_userright_structure']) {
							?>
							<li><a href="/admin/all/userright/" ><img class="icon" src="/img/cms.azbn.ru/userright.png" /> Права доступа</a></li>
							<?
							}
							?>
							
							
							<?
							if($_SESSION['user']['right']['change_settings']) {
							?>
							<li class="divider" ></li>
							
							<li><a href="/admin/page/settings/" ><img class="icon" src="/img/cms.azbn.ru/settings.png" /> Настройки</a></li>
							<?
							}
							?>
							
							<?
							if($_SESSION['user']['right']['access_debug']) {
							?>
							<li><a href="/admin/page/debug/" ><img class="icon" src="/img/cms.azbn.ru/debug.png" /> Отладка</a></li>
							<?
							}
							?>
							
						</ul>
					</div>
				</li>
				
				<li class="pull-right" >
					<div class="btn-group" role="group">
						<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							<img class="icon" src="/img/cms.azbn.ru/add.png" /><span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu">
							
							<?
							if($_SESSION['user']['right']['change_page_add']) {
							?>
							<li><a href="/admin/add/page/" >Добавить страницу</a></li>
							<?
								}
							?>
							
							<?
							if($_SESSION['user']['right']['change_post_add']) {
							?>
							<li><a href="/admin/add/post/" >Добавить пост</a></li>
							<?
								}
							?>
							
							<?
							if($_SESSION['user']['right']['change_news_add']) {
							?>
							<li><a href="/admin/add/news/" >Добавить новость</a></li>
							<?
								}
							?>
							
							<?
							if($_SESSION['user']['right']['change_geopoint_add']) {
							?>
							<li><a href="/admin/add/geopoint/" >Добавить геометку</a></li>
							<?
								}
							?>
							
							<?
							if($_SESSION['user']['right']['change_product_add']) {
							?>
							<li><a href="/admin/add/product/" >Добавить товар</a></li>
							<?
								}
							?>
							
							<?
							if($_SESSION['user']['right']['change_calendar_add']) {
							?>
							<li><a href="/admin/add/calendar/" >Добавить событие</a></li>
							<?
								}
							?>
							
							<?
							if($_SESSION['user']['right']['change_banner']) {
							?>
							<li><a href="/admin/add/banner/" >Добавить баннер</a></li>
							<?
								}
							?>
							
							<?
							if($_SESSION['user']['right']['create_usertask']) {
							?>
							<li><a href="/admin/add/usertask/" >Добавить задание</a></li>
							<?
								}
							?>
							
						</ul>
					</div>
				</li>
				
			</ul>
			
		</div>
		
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
			<hr />
		</div>
		
	</div>
	
	<div class="row">
		
		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" >


<!--<div class="btn-group-vertical btn-block" role="group" ></div>-->
			
			<?
			//$param['mdl']['hot_updates']='admin/hot_updates';
			//$this->FE->Viewer->module_live('hot_updates',$param);
			//
			$this->FE->PluginMng->event('admin:viewer:leftcol_widget', $param);
			?>
			
		</div>
		
		<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9" ><!-- id="AdminAPIResult" -->
			