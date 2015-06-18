<?
// автор @mightymind
// настройки движка ForEach

//ignore_user_abort(true);
@error_reporting(E_ALL | E_NOTICE | E_ERROR | E_WARNING | E_PARSE | E_CORE_ERROR | E_CORE_WARNING);
//@error_reporting(0); // отключение вывода ошибок и предупреждений
@set_time_limit(0); // отключение лимита на время работы скрипта
@ini_set('register_globals', false); // отключение register_globals
@ini_set('memory_limit', '32M'); // определение лимита для выделения памяти
@date_default_timezone_set('Europe/Moscow');

$prefix='cms';
$CONFIG=array(
	'debug'=>0,
	'site'=>'cms.azbn.ru',
	'base_url'=>'http://cms.azbn.ru/',
	'charset'=>'UTF-8',
	
	'upload_path'=>'upload',
	'cache_path'=>'cache',
	'sys_path'=>'/var/www/fe/3.3/include',
	'app_path'=>'apps',
	'phpmorphy_path'=>'/var/www/phpmorphy/0.3.7/',
	'backup_path'=>'backup',
	'plugin_path'=>'plugin',
	
	'main_app'=>'Main',
	'main_app_function'=>'index',
	'main_app_content_type'=>'text/html',
	'error_app'=>'Error',
	'error_app_function'=>'index',
	
	'admin_app_key'=>'iamadmin',
	
	'mysql_host'=>'localhost',
	'mysql_user'=>'cms_azbn_ru',
	'mysql_pass'=>'cms_azbn_ru',
	'mysql_base'=>'cms_azbn_ru',
	
	'mysql_prefix'=>$prefix,
	
	'mysql_tables'=>array(
		't_param'=>$prefix.'_param',
		't_backup'=>$prefix.'_backup',
		't_alias'=>$prefix.'_alias',
		't_seo'=>$prefix.'_seo',
		't_cache'=>$prefix.'_cache',
		't_log'=>$prefix.'_log',
		't_entity'=>$prefix.'_entity',
		't_plugin'=>$prefix.'_plugin',
		
		't_user'=>$prefix.'_user',
		't_userright'=>$prefix.'_userright',
		't_usertask'=>$prefix.'_usertask',
		
		't_apiapp'=>$prefix.'_apiapp',
		't_apicall'=>$prefix.'_apicall',
		't_adminapicall'=>$prefix.'_adminapicall',
		
		't_uplfile'=>$prefix.'_uplfile',
		't_uplimg'=>$prefix.'_uplimg',
		
		't_bannercat'=>$prefix.'_bannercat',
		't_banner'=>$prefix.'_banner',
		
		't_ftsearch'=>$prefix.'_ftsearch',
		
		't_filter'=>$prefix.'_filter',
		
		't_pagecat'=>$prefix.'_pagecat',
		't_page'=>$prefix.'_page',
		
		't_postcat'=>$prefix.'_postcat',
		't_post'=>$prefix.'_post',
		
		't_newscat'=>$prefix.'_newscat',
		't_news'=>$prefix.'_news',
		
		't_calendar'=>$prefix.'_calendar',
		
		't_profile'=>$prefix.'_profile',
		
		't_productcat'=>$prefix.'_productcat',
		't_product'=>$prefix.'_product',
		
		't_order'=>$prefix.'_order',
		't_orderitem'=>$prefix.'_orderitem',
		
		't_gallery'=>$prefix.'_gallery',
		't_galleryitem'=>$prefix.'_galleryitem',
		
		't_feedback'=>$prefix.'_feedback',
		't_faq'=>$prefix.'_faq',
		
		't_geopointcat'=>$prefix.'_geopointcat',
		't_geopoint'=>$prefix.'_geopoint',
		),
	
	'other_db'=>array(
		
		'other_db'=>array(
			'debug'=>0,
			'mysql_host'=>'localhost',
			'mysql_base'=>'base',
			'mysql_user'=>'root',
			'mysql_pass'=>'',
			'mysql_tables'=>array(
				't_param'=>'t_param',
				),
			),
		
		),
	
	'pagination'=>array(
		'item_count'=>10,
		),
	
	'enginetitle'=>'CMS.Azbn.RU',
	'enginedescription'=>'',
	'metrika_counter'=>'',
	
	);

?>