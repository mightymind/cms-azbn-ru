<?
// CMS Azbn.ru Публичная версия

class Install
{
public $class_name='install';

	function __construct()
	{
		
		}
	
	public function loadPluginMng($tag='')
	{
		if(!isset($this->FE->PluginMng) || $this->FE->PluginMng==null) {
			$this->FE->load(array('path'=>$this->FE->config['app_path'],'class'=>'Pluginmng','var'=>'PluginMng'));
		}
		if($tag=='') {
			$this->FE->PluginMng->loadPlugins($this->class_name, false);
		} else {
			$this->FE->PluginMng->loadPlugins($tag, false);
		}
	}
	
	public function clear(&$param)
	{
		/*
		@copy('cache/cms.azbn.ru','cache/'.$this->FE->config['site']);
		@copy('cron/cms.azbn.ru','cron/'.$this->FE->config['site']);
		@copy('css/cms.azbn.ru','css/'.$this->FE->config['site']);
		@copy('download/cms.azbn.ru','download/'.$this->FE->config['site']);
		@copy('img/cms.azbn.ru','img/'.$this->FE->config['site']);
		@copy('js/cms.azbn.ru','js/'.$this->FE->config['site']);
		@copy('litedb/cms.azbn.ru','litedb/'.$this->FE->config['site']);
		@copy('upload/cms.azbn.ru','upload/'.$this->FE->config['site']);
		*/
		
		$this->loadPluginMng();
		
		echo '<hr />';
		
		$imgs=$this->FE->DB->dbSelect("SELECT * FROM `".$this->FE->DB->dbtables['t_uplimg']."` ORDER BY id");
		while($row=mysql_fetch_array($imgs)) {
			@unlink('.'.$row['url']);
		}
		echo 'Images are deleted.<br />';
		
		$files=$this->FE->DB->dbSelect("SELECT * FROM `".$this->FE->DB->dbtables['t_uplfile']."` ORDER BY id");
		while($row=mysql_fetch_array($files)) {
			@unlink('.'.$row['url']);
		}
		echo 'Files are deleted.<br />';
		
		$backups=$this->FE->DB->dbSelect("SELECT * FROM `".$this->FE->DB->dbtables['t_backup']."` ORDER BY id");
		while($row=mysql_fetch_array($backups)) {
			if($row['entity']) {
				$file=$this->FE->config['backup_path'].'/'.$this->FE->config['site'].'/'.$row['el_type'].'/'.$row['created_at'].'_'.$row['entity'].'_'.$row['el_id'].'_'.$row['user'];
			} else {
				$file=$this->FE->config['backup_path'].'/'.$this->FE->config['site'].'/'.$row['el_type'].'/'.$row['created_at'].'_0_'.$row['el_id'].'_'.$row['user'];
			}
			@unlink($file);
		}
		echo 'Backups are deleted.<br />';
		
		$entities=$this->FE->DB->dbSelect("SELECT * FROM `".$this->FE->DB->dbtables['t_entity']."` ORDER BY id");
		while($row=mysql_fetch_array($entities)) {
			$this->FE->DB->dbQuery("DROP TABLE `".$this->FE->config['mysql_prefix'].'_'.$row['url']."cat`");
			$this->FE->DB->dbQuery("DROP TABLE `".$this->FE->config['mysql_prefix'].'_'.$row['url']."`");
		}
		echo 'Entities are deleted.<br />';
		
		
		/*
		function removePluginDir($path) {
			if (is_file($path)) {
				@unlink($path);
			} else {
				array_map('removePluginDir',glob('/*')) == @rmdir($path);
			}
			@rmdir($path);
		}
		*/
		
		$plugins=$this->FE->DB->dbSelect("SELECT * FROM `".$this->FE->DB->dbtables['t_plugin']."` WHERE 1 ORDER BY rating, id");
		while($row=mysql_fetch_array($plugins)) {
			$this->FE->PluginMng->removePluginDirectory($this->FE->PluginMng->getPluginDirectory($row['id']));
		}
		echo 'Plugins are deleted.<br />';//die();
		
		
		
		echo '<hr />';
		
		foreach($this->FE->DB->dbtables as $index=>$table) {
			$this->FE->DB->dbQuery("DROP TABLE `$table`");
			}
		
		echo 'Tables is droped.<br />';
		
		$this->FE->go2('/install/main/');
		}
	
	public function main(&$param)
	{
		
		echo '<hr />';
		
		$table_name=$this->FE->DB->dbtables['t_param'];
		if($this->FE->DB->dbQuery("CREATE TABLE IF NOT EXISTS `$table_name` (
		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`param` VARCHAR(64) NOT NULL UNIQUE,
		`value` MEDIUMBLOB DEFAULT ''
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		")) { //`editable` INT DEFAULT '1',
			echo 'Table <b>'.$table_name.'</b> is installed<br />';
			} else {
				echo 'Table <b>'.$table_name.'</b> <b>is not</b> installed<br />';
				}
		
		$this->FE->CMS->setParamValue('created_at',$this->FE->date);
		$this->FE->CMS->setParamValue('fe_version_number',$this->FE->version['number']);
		$this->FE->CMS->setParamValue('fe_version_date',$this->FE->version['date']);
		
		
		
		$table_name=$this->FE->DB->dbtables['t_backup'];
		if($this->FE->DB->dbQuery("CREATE TABLE IF NOT EXISTS `$table_name` (
		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`created_at` INT DEFAULT '0',
		`user` INT DEFAULT '0',
		`entity` INT DEFAULT '0',
		`el_id` INT DEFAULT '0',
		`el_type` VARCHAR(16) DEFAULT 'none'
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		")) {
			echo 'Table <b>'.$table_name.'</b> is installed<br />';
			} else {
				echo 'Table <b>'.$table_name.'</b> <b>is not</b> installed<br />';
				}
		
		
		$table_name=$this->FE->DB->dbtables['t_alias'];
		if($this->FE->DB->dbQuery("CREATE TABLE IF NOT EXISTS `$table_name` (
		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`sure` INT DEFAULT '1',
		`type` VARCHAR(64) DEFAULT 'text/html',
		`req` VARCHAR(256) NOT NULL UNIQUE,
		`to` VARCHAR(512) DEFAULT '',
		INDEX req_index (`req`(64)),
		INDEX to_index (`to`(64))
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		")) {
			echo 'Table <b>'.$table_name.'</b> is installed<br />';
			} else {
				echo 'Table <b>'.$table_name.'</b> <b>is not</b> installed<br />';
				}
				
		$this->FE->CMS->setAlias(array('req'=>'/robots.txt','type'=>'text/plain','to'=>'/main/pageByTpl/notHTML/robots.txt'));
		$this->FE->CMS->setAlias(array('req'=>'/cache.manifest','type'=>'text/cache-manifest','to'=>'/main/pageByTpl/notHTML/cache.manifest'));
		$this->FE->CMS->setAlias(array('req'=>'/offline','type'=>'text/plain','to'=>'/main/pageByTpl/notHTML/offline'));
		
		$alias_arr=array(
			'list'=>array(),
			'sure'=>array(),
			'similar'=>array(),
			);
		$alias=$this->FE->DB->dbSelect("SELECT * FROM `$table_name` ORDER BY sure DESC, id");
		while($row=mysql_fetch_array($alias)) {
			$alias_arr['list'][$row['req']]=array(
				'id'=>$this->FE->as_int($row['id']),
				'sure'=>$this->FE->as_int($row['sure']),
				'type'=>$row['type'],
				'req'=>$row['req'],
				'to'=>$row['to'],
				);
			if($row['sure']) {
				$alias_arr['sure'][$row['req']]=&$alias_arr['list'][$row['req']]['to'];
			} else {
				$alias_arr['similar'][$row['req']]=&$alias_arr['list'][$row['req']]['to'];
			}
		}
		$this->FE->CMS->setParamValue('cms_alias_array',serialize($alias_arr));
		$this->FE->config['alias']=$this->FE->CMS->getParamValueAsArr('cms_alias_array');
		
		
		$table_name=$this->FE->DB->dbtables['t_seo'];
		if($this->FE->DB->dbQuery("CREATE TABLE IF NOT EXISTS `$table_name` (
		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`title` VARCHAR(256) DEFAULT '',
		`desc` VARCHAR(256) DEFAULT '',
		`kw` VARCHAR(256) DEFAULT ''
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		")) {
			echo 'Table <b>'.$table_name.'</b> is installed<br />';
			} else {
				echo 'Table <b>'.$table_name.'</b> <b>is not</b> installed<br />';
				}
		$this->FE->CMS->setSEO(0,array('title'=>'{%title%}','desc'=>'{%description%}','kw'=>'{%keywords%}',));
		$this->FE->CMS->setSEO(0,array('title'=>'Главная страница проекта','desc'=>'Главная страница проекта','kw'=>'CMS, Azbn.ru, site, сайт',));
		$this->FE->CMS->setSEO(0,array('title'=>'Вход в административную часть сайта','desc'=>'Вход в административную часть сайта','kw'=>'',));
		$this->FE->CMS->setSEO(0,array('title'=>'Произошла ошибка! Возможно, вы ошиблись адресом или страница перестала существовать','desc'=>'Произошла ошибка! Возможно, вы ошиблись адресом или страница перестала существовать','kw'=>'',));
		$this->FE->CMS->setSEO(0,array('title'=>'Поиск {%title%} по сайту','desc'=>'Информация о {%description%} на нашем сайте','kw'=>'{%keywords%}',));
		
		$table_name=$this->FE->DB->dbtables['t_cache'];
		if ($this->FE->DB->dbQuery("CREATE TABLE IF NOT EXISTS `$table_name` (
		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`created_at` INT DEFAULT '0',
		`clear_at` INT DEFAULT '0',
		`uid` VARCHAR(64) NOT NULL,
		`text` MEDIUMBLOB DEFAULT ''
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		")) {
			echo 'Table <b>'.$table_name.'</b> is installed<br />';
			} else {
				echo 'Table <b>'.$table_name.'</b> <b>is not</b> installed<br />';
				}
		
		$table_name=$this->FE->DB->dbtables['t_log'];
		if($this->FE->DB->dbQuery("CREATE TABLE IF NOT EXISTS `$table_name` (
		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`created_at` INT DEFAULT '0',
		`user` INT DEFAULT '0',
		`el_id` INT DEFAULT '0',
		`el_type` VARCHAR(16) DEFAULT 'none',
		`type` VARCHAR(16) DEFAULT 'none',
		`param` BLOB DEFAULT ''
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		")) {
			echo 'Table <b>'.$table_name.'</b> is installed<br />';
			} else {
				echo 'Table <b>'.$table_name.'</b> <b>is not</b> installed<br />';
				}
		
		$table_name=$this->FE->DB->dbtables['t_uplfile'];
		if($this->FE->DB->dbQuery("CREATE TABLE IF NOT EXISTS `$table_name` (
		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`created_at` INT DEFAULT '0',
		`clicked` INT DEFAULT '0',
		`user` INT DEFAULT '0',
		`size` INT DEFAULT '0',
		`url` VARCHAR(256) DEFAULT '',
		`title` VARCHAR(512) DEFAULT ''
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		")) {
			echo 'Table <b>'.$table_name.'</b> is installed<br />';
			} else {
				echo 'Table <b>'.$table_name.'</b> <b>is not</b> installed<br />';
				}
		
		$table_name=$this->FE->DB->dbtables['t_uplimg'];
		if($this->FE->DB->dbQuery("CREATE TABLE IF NOT EXISTS `$table_name` (
		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`created_at` INT DEFAULT '0',
		`user` INT DEFAULT '0',
		`url` VARCHAR(256) DEFAULT ''
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		")) {
			echo 'Table <b>'.$table_name.'</b> is installed<br />';
			} else {
				echo 'Table <b>'.$table_name.'</b> <b>is not</b> installed<br />';
				}
		
		$table_name=$this->FE->DB->dbtables['t_plugin'];
		if($this->FE->DB->dbQuery("CREATE TABLE IF NOT EXISTS `$table_name` (
		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`azbn_id` INT DEFAULT '0',
		`azbn_cat` INT DEFAULT '0',
		`status` INT DEFAULT '1',
		`created_at` INT DEFAULT '0',
		`rating` INT DEFAULT '999999999',
		`uid` VARCHAR(256) DEFAULT '',
		`tag` VARCHAR(256) DEFAULT '',
		`title` VARCHAR(256) DEFAULT '',
		`preview` VARCHAR(512) DEFAULT '',
		`event` BLOB DEFAULT '',
		`param` BLOB DEFAULT ''
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		")) {
			echo 'Table <b>'.$table_name.'</b> is installed<br />';
			} else {
				echo 'Table <b>'.$table_name.'</b> <b>is not</b> installed<br />';
				}
		/*
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_plugin'],array(
			'azbn_id'=>'1',
			'azbn_cat'=>'0',
			'status'=>'1',
			'created_at'=>$this->FE->date,
			'rating'=>999999999,
			'uid'=>'Testplugin',
			'title'=>'Тестовый плагин',
			'preview'=>'Тестовый плагин для отработки механизма плагинов в CMS Azbn.ru',
			'event'=>'test_event',
			'param'=>'',
			)
		);
		*/
		
		
		$table_name=$this->FE->DB->dbtables['t_entity'];
		if($this->FE->DB->dbQuery("CREATE TABLE IF NOT EXISTS `$table_name` (
		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`ftsearch` INT DEFAULT '1',
		`title` VARCHAR(256) DEFAULT '',
		`url` VARCHAR(256) NOT NULL UNIQUE,
		`param` BLOB DEFAULT ''
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		")) {
			echo 'Table <b>'.$table_name.'</b> is installed<br />';
			} else {
				echo 'Table <b>'.$table_name.'</b> <b>is not</b> installed<br />';
				}
		/*
		//$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_entity'],array('title'=>'','url'=>''));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_entity'],array('title'=>'Страницы','url'=>'page'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_entity'],array('title'=>'Посты','url'=>'post'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_entity'],array('title'=>'Новости','url'=>'news'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_entity'],array('title'=>'Геометки','url'=>'geopoint'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_entity'],array('title'=>'Товары','url'=>'product'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_entity'],array('title'=>'Галереи','url'=>'gallery'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_entity'],array('title'=>'Календарь','url'=>'calendar'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_entity'],array('title'=>'Баннеры','url'=>'banner'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_entity'],array('title'=>'Загруженные файлы','url'=>'uplfile'));
		*/
		
		
		$table_name=$this->FE->DB->dbtables['t_userright'];
		if($this->FE->DB->dbQuery("CREATE TABLE IF NOT EXISTS `$table_name` (
		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`right_id` VARCHAR(64) DEFAULT '',
		`right_name` VARCHAR(256) DEFAULT ''
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		")) {
			echo 'Table <b>'.$table_name.'</b> is installed<br />';
			} else {
				echo 'Table <b>'.$table_name.'</b> <b>is not</b> installed<br />';
				}
		
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'is_admin','right_name'=>'Возможность администрирования'));
		
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_settings','right_name'=>'Изменение настроек сайта'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'access_debug','right_name'=>'Доступ к данным отладки'));
		
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'access_fileman','right_name'=>'Доступ к файловому менеджеру'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_alias','right_name'=>'Редактирование адресов перенаправления'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_seo','right_name'=>'Редактирование SEO-настроек'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'view_backuplist','right_name'=>'Доступ к списку редакций записей'));
		
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_userright_structure','right_name'=>'Изменение структуры уровней доступа'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_user','right_name'=>'Изменение данных и прав администраторов'));
		
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'access_plugin','right_name'=>'Доступ к управлению плагинами'));
		
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_apiapp','right_name'=>'Добавление/изменение приложений API'));
		
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'clear_log','right_name'=>'Очистка таблицы логов'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'clear_apicall','right_name'=>'Очистка таблицы вызовов API'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'clear_cache','right_name'=>'Очистка таблицы кеша'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'clear_ftsearch','right_name'=>'Очистка таблицы поискового индекса'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'clear_usertask','right_name'=>'Очистка таблицы заданий'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'clear_uplfile','right_name'=>'Очистка таблицы загрузок файлов'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'clear_uplimg','right_name'=>'Очистка таблицы загрузок изображений'));
		
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'view_log','right_name'=>'Просмотр логов'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'view_apicall','right_name'=>'Просмотр данных API'));
		
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'upload_avatar','right_name'=>'Загрузка небольших аватаров'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'upload_imgs','right_name'=>'Загрузка изображений на сервер'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'upload_files','right_name'=>'Загрузка файлов на сервер'));
		
		
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'access_entity','right_name'=>'Доступ к сущностям'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_entity_add','right_name'=>'Создание сущностей'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_entity_delete','right_name'=>'Удаление сущностей'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_entity_edit','right_name'=>'Изменение сущностей'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_entitycat_add','right_name'=>'Создание категорий (у сущностей)'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_entitycat_delete','right_name'=>'Удаление категорий (у сущностей)'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_entitycat_edit','right_name'=>'Изменение категорий (у сущностей)'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_entitycat_superuser','right_name'=>'Широкие возможности работы с категориями сущностей'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_entityitem_add','right_name'=>'Создание записей (у сущностей)'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_entityitem_delete','right_name'=>'Удаление записей (у сущностей)'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_entityitem_edit','right_name'=>'Изменение записей (у сущностей)'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_entityitem_superuser','right_name'=>'Широкие возможности работы с записями сущностей'));
		
		
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'access_usertask','right_name'=>'Доступ к заданиям'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'create_usertask','right_name'=>'Выставление заданий'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'delete_usertask','right_name'=>'Удаление заданий'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'view_all_usertask','right_name'=>'Просмотр чужих заданий'));
		
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_bannercat','right_name'=>'Редактирование позиций баннеров'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_banner','right_name'=>'Редактирование баннеров'));
		
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'access_uplfile','right_name'=>'Доступ к загруженным файлам'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_uplfile_delete','right_name'=>'Удаление загруженных файлов'));
		
		$table_name=$this->FE->DB->dbtables['t_usertask'];
		if($this->FE->DB->dbQuery("CREATE TABLE IF NOT EXISTS `$table_name` (
		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`created_at` INT DEFAULT '0',
		`user` INT DEFAULT '0',
		`user2` INT DEFAULT '0',
		`status` INT DEFAULT '0',
		`rating` INT DEFAULT '999999999',
		`title` VARCHAR(256) DEFAULT '',
		`main_info` TEXT DEFAULT '',
		`param` BLOB DEFAULT ''
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		")) {
			echo 'Table <b>'.$table_name.'</b> is installed<br />';
			} else {
				echo 'Table <b>'.$table_name.'</b> <b>is not</b> installed<br />';
				}
		
		$table_name=$this->FE->DB->dbtables['t_user'];
		if($this->FE->DB->dbQuery("CREATE TABLE IF NOT EXISTS `$table_name` (
		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`status` INT DEFAULT '1',
		`cash` DOUBLE DEFAULT '0',
		`rating` INT DEFAULT '999999999',
		`login` VARCHAR(32) NOT NULL UNIQUE,
		`pass` VARCHAR(32) DEFAULT '',
		`email` VARCHAR(64) DEFAULT '',
		`view_as` VARCHAR(128) DEFAULT 'Default user',
		`img` VARCHAR(256) DEFAULT '',
		`right` BLOB DEFAULT '',
		`param` BLOB DEFAULT ''
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		")) {
			echo 'Table <b>'.$table_name.'</b> is installed<br />'; //`right` SET(".implode(',',$set_arr).") DEFAULT '',
			} else {
				echo 'Table <b>'.$table_name.'</b> <b>is not</b> installed<br />';
				}
		
		if($this->FE->DB->dbInsert($this->FE->DB->dbtables['t_user'],array(
				'login'=>'system',
				'view_as'=>'Системный аккаунт',
				'right'=>'is_admin,change_user,access_usertask,create_usertask',
				'status'=>1,
				'rating'=>1,
				'cash'=>1,
				'pass'=>$this->FE->hash($this->FE->randstr(16),'system',$this->FE->version['secret']),
				'email'=>'cms@azbn.ru',
				'param'=>serialize(array(
							'url'=>'http://azbn.ru/',
							'vk'=>array(
									'url'=>'http://vk.com/azbn_ru'
									),
							'twitter'=>array(
									'url'=>'https://twitter.com/azbn_ru'
									),
							'email'=>'cms@azbn.ru',
							'adr'=>'Орел',
							'phone'=>'79092266632',
							'default_editor'=>'textarea',
							'timezone'=>'Europe/Moscow',
							))
				))) echo 'system is installed<br />';
		
		if($this->FE->DB->dbInsert($this->FE->DB->dbtables['t_user'],array(
				'login'=>'admin',
				'view_as'=>'admin',
				'right'=>'is_admin,change_user,access_usertask,create_usertask',
				'status'=>1,
				'rating'=>1,
				'cash'=>1,
				'pass'=>$this->FE->hash('admin','admin',$this->FE->version['secret']),
				'email'=>'cms@azbn.ru',
				'param'=>serialize(array(
							'url'=>'http://azbn.ru/',
							'vk'=>array(
									'url'=>'http://vk.com/azbn_ru'
									),
							'twitter'=>array(
									'url'=>'https://twitter.com/azbn_ru'
									),
							'email'=>'cms@azbn.ru',
							'adr'=>'Орел',
							'phone'=>'71234567890',
							'default_editor'=>'cmsazbn',
							'timezone'=>'Europe/Moscow',
							))
				))) echo 'admin is installed<br />';
		
		$table_name=$this->FE->DB->dbtables['t_apiapp'];
		if($this->FE->DB->dbQuery("CREATE TABLE IF NOT EXISTS `$table_name` (
		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`status` INT DEFAULT '1',
		`rating` INT DEFAULT '999999999',
		`login` VARCHAR(32) NOT NULL,
		`pass` VARCHAR(32) DEFAULT '',
		`app_key` VARCHAR(32) DEFAULT '',
		`param` BLOB DEFAULT ''
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		")) {
			echo 'Table <b>'.$table_name.'</b> is installed<br />';
			} else {
				echo 'Table <b>'.$table_name.'</b> <b>is not</b> installed<br />';
				}
		
		$table_name=$this->FE->DB->dbtables['t_apicall'];
		if($this->FE->DB->dbQuery("CREATE TABLE IF NOT EXISTS `$table_name` (
		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`created_at` INT DEFAULT '0',
		`app` INT DEFAULT '0',
		`service` VARCHAR(32) DEFAULT '',
		`method` VARCHAR(32) DEFAULT '',
		`param` BLOB DEFAULT ''
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		")) {
			echo 'Table <b>'.$table_name.'</b> is installed<br />';
			} else {
				echo 'Table <b>'.$table_name.'</b> <b>is not</b> installed<br />';
				}
		
		$table_name=$this->FE->DB->dbtables['t_adminapicall'];
		if($this->FE->DB->dbQuery("CREATE TABLE IF NOT EXISTS `$table_name` (
		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`created_at` INT DEFAULT '0',
		`app` INT DEFAULT '0',
		`service` VARCHAR(32) DEFAULT '',
		`method` VARCHAR(32) DEFAULT '',
		`param` BLOB DEFAULT ''
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		")) {
			echo 'Table <b>'.$table_name.'</b> is installed<br />';
			} else {
				echo 'Table <b>'.$table_name.'</b> <b>is not</b> installed<br />';
				}
		
		$main_app=array(
					'status'=>1,
					'rating'=>1,
					'login'=>'admin',
					'pass'=>$this->FE->hash('admin'),
					'app_key'=>'iamadmin',
					'param'=>serialize(array())
					);
		
		echo '<b>App id #'.$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_apiapp'],$main_app).'</b> is installed<br />';
		echo 'Admin App-key: '.$main_app['app_key'].'<br /><br />';
		
		$main_app=array(
					'status'=>1,
					'rating'=>999999999,
					'login'=>'public',
					'pass'=>$this->FE->hash('public'),
					'app_key'=>'public',
					'param'=>serialize(array())
					);
		
		echo '<b>App id #'.$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_apiapp'],$main_app).'</b> is installed<br />';
		echo 'Public App-key: '.$main_app['app_key'].'<br /><br />';
		
		
		$table_name=$this->FE->DB->dbtables['t_bannercat'];
		if($this->FE->DB->dbQuery("CREATE TABLE IF NOT EXISTS `$table_name` (
			`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`parent` INT DEFAULT '0',
			`visible` INT DEFAULT '1',
			`title` VARCHAR(256) DEFAULT '',
			`img` VARCHAR(256) DEFAULT '',
			`preview` VARCHAR(512) DEFAULT '',
			`param` BLOB DEFAULT ''
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;
			")) {
			echo 'Table <b>'.$table_name.'</b> is installed<br />';
			} else {
				echo 'Table <b>'.$table_name.'</b> <b>is not</b> installed<br />';
				}
		
		$table_name=$this->FE->DB->dbtables['t_banner'];
		if($this->FE->DB->dbQuery("CREATE TABLE IF NOT EXISTS `$table_name` (
		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`view_at` INT DEFAULT '0',
		`clicked` INT DEFAULT '0',
		`rating` INT DEFAULT '999999999',
		`img` VARCHAR(256) DEFAULT '',
		`url` VARCHAR(256) DEFAULT '',
		`title` VARCHAR(256) DEFAULT ''
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		")) {
			echo 'Table <b>'.$table_name.'</b> is installed<br />';
			} else {
				echo 'Table <b>'.$table_name.'</b> <b>is not</b> installed<br />';
				}
		
		$table_name=$this->FE->DB->dbtables['t_ftsearch'];
		if($this->FE->DB->dbQuery("CREATE TABLE IF NOT EXISTS `$table_name` (
		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`created_at` INT DEFAULT '0',
		`updated_at` INT DEFAULT '0',
		`visible` INT DEFAULT '1',
		`entity` INT DEFAULT '0',
		`rating` INT DEFAULT '999999999',
		`el_id` INT DEFAULT '0',
		`el_type` VARCHAR(16) DEFAULT 'none',
		`main_info` LONGTEXT DEFAULT '',
		INDEX el_index (el_id, el_type),
		FULLTEXT KEY `ftsearch` (`main_info`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		")) {
			echo 'Table <b>'.$table_name.'</b> is installed<br />';
			} else {
				echo 'Table <b>'.$table_name.'</b> <b>is not</b> installed<br />';
				}
		
		$this->FE->go2('/install/site/');
		
		}
	
	public function site(&$param)
	{
		
		echo '<hr />';
		
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'access_filter','right_name'=>'Редактирование фильтров информации'));
		
		$table_name=$this->FE->DB->dbtables['t_filter'];
		if($this->FE->DB->dbQuery("CREATE TABLE IF NOT EXISTS `$table_name` (
			`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`parent` INT DEFAULT '0',
			`visible` INT DEFAULT '1',
			`title` VARCHAR(256) DEFAULT '',
			`param` BLOB DEFAULT ''
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;
			")) {
			echo 'Table <b>'.$table_name.'</b> is installed<br />';
			} else {
				echo 'Table <b>'.$table_name.'</b> <b>is not</b> installed<br />';
				}
		
		
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'access_page','right_name'=>'Доступ к страницам'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_pagecat_edit','right_name'=>'Редактирование разделов страниц'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_page_add','right_name'=>'Добавление страниц'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_page_delete','right_name'=>'Удаление страниц'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_page_edit','right_name'=>'Редактирование страниц'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_page_superuser','right_name'=>'Широкие возможности изменения страниц'));
		
		$table_name=$this->FE->DB->dbtables['t_pagecat'];
		if($this->FE->DB->dbQuery("CREATE TABLE IF NOT EXISTS `$table_name` (
			`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`parent` INT DEFAULT '0',
			`visible` INT DEFAULT '1',
			`seo` INT DEFAULT '0',
			`title` VARCHAR(256) DEFAULT '',
			`url` VARCHAR(256) DEFAULT '',
			`img` VARCHAR(256) DEFAULT '',
			`preview` VARCHAR(512) DEFAULT '',
			`param` BLOB DEFAULT '' ".$this->getFullTextInstallStr('cat').",
			INDEX url_index (url(32))
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;
			")) {
			echo 'Table <b>'.$table_name.'</b> is installed<br />';
			} else {
				echo 'Table <b>'.$table_name.'</b> <b>is not</b> installed<br />';
				}
		$table_name=$this->FE->DB->dbtables['t_page'];
		if($this->FE->DB->dbQuery("CREATE TABLE IF NOT EXISTS `$table_name` (
			`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`created_at` INT DEFAULT '0',
			`cat` INT DEFAULT '0',
			`visible` INT DEFAULT '1',
			`seo` INT DEFAULT '0',
			`rating` INT DEFAULT '999999999',
			`user` INT DEFAULT '1',
			`title` VARCHAR(256) DEFAULT '',
			`url` VARCHAR(256) DEFAULT '',
			`img` VARCHAR(256) DEFAULT '',
			`gal` VARCHAR(256) DEFAULT '',
			`preview` VARCHAR(512) DEFAULT '',
			`tag` VARCHAR(512) DEFAULT '',
			`main_info` MEDIUMTEXT DEFAULT '',
			`filter` BLOB DEFAULT '',
			`param` BLOB DEFAULT '' ".$this->getFullTextInstallStr('item').",
			INDEX url_index (url(32))
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;
			")) {
			echo 'Table <b>'.$table_name.'</b> is installed<br />';
			} else {
				echo 'Table <b>'.$table_name.'</b> <b>is not</b> installed<br />';
				}
		
		
		
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'access_post','right_name'=>'Доступ к постам'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_postcat_edit','right_name'=>'Редактирование разделов постов'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_post_add','right_name'=>'Добавление постов'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_post_delete','right_name'=>'Удаление постов'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_post_edit','right_name'=>'Редактирование постов'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_post_superuser','right_name'=>'Широкие возможности изменения постов'));
		
		$table_name=$this->FE->DB->dbtables['t_postcat'];
		if($this->FE->DB->dbQuery("CREATE TABLE IF NOT EXISTS `$table_name` (
			`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`parent` INT DEFAULT '0',
			`visible` INT DEFAULT '1',
			`seo` INT DEFAULT '0',
			`title` VARCHAR(256) DEFAULT '',
			`url` VARCHAR(256) DEFAULT '',
			`img` VARCHAR(256) DEFAULT '',
			`preview` VARCHAR(512) DEFAULT '',
			`param` BLOB DEFAULT '' ".$this->getFullTextInstallStr('cat').",
			INDEX url_index (url(32))
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;
			")) {
			echo 'Table <b>'.$table_name.'</b> is installed<br />';
			} else {
				echo 'Table <b>'.$table_name.'</b> <b>is not</b> installed<br />';
				}
		$table_name=$this->FE->DB->dbtables['t_post'];
		if($this->FE->DB->dbQuery("CREATE TABLE IF NOT EXISTS `$table_name` (
			`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`created_at` INT DEFAULT '0',
			`cat` INT DEFAULT '0',
			`visible` INT DEFAULT '1',
			`seo` INT DEFAULT '0',
			`rating` INT DEFAULT '999999999',
			`user` INT DEFAULT '1',
			`title` VARCHAR(256) DEFAULT '',
			`url` VARCHAR(256) DEFAULT '',
			`img` VARCHAR(256) DEFAULT '',
			`gal` VARCHAR(256) DEFAULT '',
			`preview` VARCHAR(512) DEFAULT '',
			`tag` VARCHAR(512) DEFAULT '',
			`main_info` MEDIUMTEXT DEFAULT '',
			`filter` BLOB DEFAULT '',
			`param` BLOB DEFAULT '' ".$this->getFullTextInstallStr('item').",
			INDEX url_index (url(32))
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;
			")) {
			echo 'Table <b>'.$table_name.'</b> is installed<br />';
			} else {
				echo 'Table <b>'.$table_name.'</b> <b>is not</b> installed<br />';
				}
		
		
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'access_news','right_name'=>'Доступ к новостям'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_newscat_edit','right_name'=>'Редактирование разделов новостей'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_news_add','right_name'=>'Добавление новостей'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_news_delete','right_name'=>'Удаление новостей'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_news_edit','right_name'=>'Редактирование новостей'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_news_superuser','right_name'=>'Широкие возможности изменения новостей'));
		
		$table_name=$this->FE->DB->dbtables['t_newscat'];
		if($this->FE->DB->dbQuery("CREATE TABLE IF NOT EXISTS `$table_name` (
			`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`parent` INT DEFAULT '0',
			`visible` INT DEFAULT '1',
			`seo` INT DEFAULT '0',
			`title` VARCHAR(256) DEFAULT '',
			`url` VARCHAR(256) DEFAULT '',
			`img` VARCHAR(256) DEFAULT '',
			`preview` VARCHAR(512) DEFAULT '',
			`param` BLOB DEFAULT '' ".$this->getFullTextInstallStr('cat').",
			INDEX url_index (url(32))
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;
			")) {
			echo 'Table <b>'.$table_name.'</b> is installed<br />';
			} else {
				echo 'Table <b>'.$table_name.'</b> <b>is not</b> installed<br />';
				}
		$table_name=$this->FE->DB->dbtables['t_news'];
		if($this->FE->DB->dbQuery("CREATE TABLE IF NOT EXISTS `$table_name` (
			`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`created_at` INT DEFAULT '0',
			`date` INT DEFAULT '0',
			`cat` INT DEFAULT '0',
			`visible` INT DEFAULT '1',
			`seo` INT DEFAULT '0',
			`rating` INT DEFAULT '999999999',
			`user` INT DEFAULT '1',
			`title` VARCHAR(256) DEFAULT '',
			`url` VARCHAR(256) DEFAULT '',
			`img` VARCHAR(256) DEFAULT '',
			`gal` VARCHAR(256) DEFAULT '',
			`preview` VARCHAR(512) DEFAULT '',
			`tag` VARCHAR(512) DEFAULT '',
			`main_info` MEDIUMTEXT DEFAULT '',
			`filter` BLOB DEFAULT '',
			`param` BLOB DEFAULT '' ".$this->getFullTextInstallStr('item').",
			INDEX url_index (url(32))
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;
			")) {
			echo 'Table <b>'.$table_name.'</b> is installed<br />';
			} else {
				echo 'Table <b>'.$table_name.'</b> <b>is not</b> installed<br />';
				}
		
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'access_calendar','right_name'=>'Доступ к событиям календаря'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_calendar_add','right_name'=>'Добавление событий в календарь'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_calendar_delete','right_name'=>'Удаление событий из календаря'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_calendar_edit','right_name'=>'Редактирование событий календаря'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_calendar_superuser','right_name'=>'Широкие возможности изменения событий календаря'));
		
		$table_name=$this->FE->DB->dbtables['t_calendar'];
		if($this->FE->DB->dbQuery("CREATE TABLE IF NOT EXISTS `$table_name` (
			`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`created_at` INT DEFAULT '0',
			`start_at` INT DEFAULT '0',
			`stop_at` INT DEFAULT '0',
			`visible` INT DEFAULT '1',
			`seo` INT DEFAULT '0',
			`rating` INT DEFAULT '999999999',
			`user` INT DEFAULT '1',
			`title` VARCHAR(256) DEFAULT '',
			`url` VARCHAR(256) DEFAULT '',
			`img` VARCHAR(256) DEFAULT '',
			`gal` VARCHAR(256) DEFAULT '',
			`preview` VARCHAR(512) DEFAULT '',
			`tag` VARCHAR(512) DEFAULT '',
			`main_info` MEDIUMTEXT DEFAULT '',
			`filter` BLOB DEFAULT '',
			`param` BLOB DEFAULT '' ".$this->getFullTextInstallStr('item').",
			INDEX url_index (url(32))
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;
			")) {
			echo 'Table <b>'.$table_name.'</b> is installed<br />';
			} else {
				echo 'Table <b>'.$table_name.'</b> <b>is not</b> installed<br />';
				}
		
		
		
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'access_product','right_name'=>'Доступ к каталогу товаров'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_productcat_edit','right_name'=>'Редактирование категорий товаров'));
		//$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_productflt_edit','right_name'=>'Редактирование фильтров товаров'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_product_add','right_name'=>'Добавление товаров в каталог'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_product_delete','right_name'=>'Удаление товаров из каталога'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_product_edit','right_name'=>'Редактирование товаров в каталоге'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_product_superuser','right_name'=>'Широкие возможности работы с товарами'));
		
		$table_name=$this->FE->DB->dbtables['t_productcat'];
		if($this->FE->DB->dbQuery("CREATE TABLE IF NOT EXISTS `$table_name` (
			`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`parent` INT DEFAULT '0',
			`visible` INT DEFAULT '1',
			`seo` INT DEFAULT '0',
			`title` VARCHAR(256) DEFAULT '',
			`url` VARCHAR(256) DEFAULT '',
			`img` VARCHAR(256) DEFAULT '',
			`preview` VARCHAR(512) DEFAULT '',
			`param` BLOB DEFAULT '' ".$this->getFullTextInstallStr('cat').",
			INDEX url_index (url(32))
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;
			")) {
			echo 'Table <b>'.$table_name.'</b> is installed<br />';
			} else {
				echo 'Table <b>'.$table_name.'</b> <b>is not</b> installed<br />';
				}
		
		$table_name=$this->FE->DB->dbtables['t_product'];
		if($this->FE->DB->dbQuery("CREATE TABLE IF NOT EXISTS `$table_name` (
			`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`created_at` INT DEFAULT '0',
			`cat` INT DEFAULT '0',
			`visible` INT DEFAULT '1',
			`seo` INT DEFAULT '0',
			`rating` INT DEFAULT '999999999',
			`user` INT DEFAULT '1',
			`count` INT DEFAULT '0',
			`cost` DOUBLE DEFAULT '0',
			`oldcost` DOUBLE DEFAULT '0',
			`unit` VARCHAR(16) DEFAULT '',
			`uid` VARCHAR(64) NOT NULL UNIQUE,
			`title` VARCHAR(256) DEFAULT '',
			`url` VARCHAR(256) DEFAULT '',
			`img` VARCHAR(256) DEFAULT '',
			`gal` VARCHAR(256) DEFAULT '',
			`preview` VARCHAR(512) DEFAULT '',
			`tag` VARCHAR(512) DEFAULT '',
			`main_info` MEDIUMTEXT DEFAULT '',
			`filter` BLOB DEFAULT '',
			`param` BLOB DEFAULT '' ".$this->getFullTextInstallStr('item').",
			INDEX url_index (url(32))
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;
			")) {
			echo 'Table <b>'.$table_name.'</b> is installed<br />';
			} else {
				echo 'Table <b>'.$table_name.'</b> <b>is not</b> installed<br />';
				}
		
		
		
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'access_order','right_name'=>'Доступ к заказам товаров'));
		//$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_order_add','right_name'=>'Добавление заказов'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_order_delete','right_name'=>'Удаление заказов'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_order_edit','right_name'=>'Редактирование заказов'));
		//$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_order_superuser','right_name'=>'Широкие возможности работы с заказами'));
		
		$table_name=$this->FE->DB->dbtables['t_order'];
		if($this->FE->DB->dbQuery("CREATE TABLE IF NOT EXISTS `$table_name` (
			`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`created_at` INT DEFAULT '0',
			`profile` INT DEFAULT '0',
			`status` INT DEFAULT '1',
			`sum` DOUBLE DEFAULT '0',
			`param` BLOB DEFAULT ''
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;
			")) {
			echo 'Table <b>'.$table_name.'</b> is installed<br />';
			} else {
				echo 'Table <b>'.$table_name.'</b> <b>is not</b> installed<br />';
				}
		
		$table_name=$this->FE->DB->dbtables['t_orderitem'];
		if($this->FE->DB->dbQuery("CREATE TABLE IF NOT EXISTS `$table_name` (
			`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`order_id` INT DEFAULT '0',
			`product_id` INT DEFAULT '0',
			`amount` INT DEFAULT '1',
			`at_cost` DOUBLE DEFAULT '0',
			`param` BLOB DEFAULT ''
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;
			")) {
			echo 'Table <b>'.$table_name.'</b> is installed<br />';
			} else {
				echo 'Table <b>'.$table_name.'</b> <b>is not</b> installed<br />';
				}
		
		
		
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'access_profile','right_name'=>'Доступ к списку пользователей'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_profile_add','right_name'=>'Возможность создавать пользователей'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_profile_block','right_name'=>'Возможность блокировать пользователей'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_profile_edit','right_name'=>'Редактирование данных пользователей'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_profile_superuser','right_name'=>'Широкие возможности работы с пользователями'));
		
		$table_name=$this->FE->DB->dbtables['t_profile'];
		if($this->FE->DB->dbQuery("CREATE TABLE IF NOT EXISTS `$table_name` (
		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`status` INT DEFAULT '1',
		`seo` INT DEFAULT '0',
		`cash` DOUBLE DEFAULT '0',
		`rating` INT DEFAULT '999999999',
		`login` VARCHAR(32) NOT NULL UNIQUE,
		`pass` VARCHAR(32) DEFAULT '',
		`email` VARCHAR(64) DEFAULT '',
		`view_as` VARCHAR(128) DEFAULT 'Default user',
		`img` VARCHAR(256) DEFAULT '',
		`right` BLOB DEFAULT '',
		`filter` BLOB DEFAULT '',
		`param` BLOB DEFAULT ''
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		")) {
			echo 'Table <b>'.$table_name.'</b> is installed<br />';
			} else {
				echo 'Table <b>'.$table_name.'</b> <b>is not</b> installed<br />';
				}
		
		
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'access_gallery','right_name'=>'Доступ к галерее'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_gallery_edit','right_name'=>'Редактирование разделов галерей'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_galleryitem_add','right_name'=>'Добавление фото в галереи'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_galleryitem_delete','right_name'=>'Удаление фото из галерей'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_galleryitem_edit','right_name'=>'Редактирование фото в галереях'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_gallery_superuser','right_name'=>'Широкие возможности изменения галерей'));
		
		$table_name=$this->FE->DB->dbtables['t_gallery'];
		if($this->FE->DB->dbQuery("CREATE TABLE IF NOT EXISTS `$table_name` (
			`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`parent` INT DEFAULT '0',
			`visible` INT DEFAULT '1',
			`seo` INT DEFAULT '0',
			`w` INT DEFAULT '1',
			`h` INT DEFAULT '1',
			`crop` INT DEFAULT '0',
			`title` VARCHAR(256) DEFAULT '',
			`url` VARCHAR(256) DEFAULT '',
			`img` VARCHAR(256) DEFAULT '',
			`preview` VARCHAR(512) DEFAULT '',
			`filter` BLOB DEFAULT '',
			`param` BLOB DEFAULT '' ".$this->getFullTextInstallStr('cat').",
			INDEX url_index (url(32))
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;
			")) {
			echo 'Table <b>'.$table_name.'</b> is installed<br />';
			} else {
				echo 'Table <b>'.$table_name.'</b> <b>is not</b> installed<br />';
				}
		$table_name=$this->FE->DB->dbtables['t_galleryitem'];
		if($this->FE->DB->dbQuery("CREATE TABLE IF NOT EXISTS `$table_name` (
			`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`created_at` INT DEFAULT '0',
			`gal` INT DEFAULT '0',
			`visible` INT DEFAULT '1',
			`seo` INT DEFAULT '0',
			`rating` INT DEFAULT '999999999',
			`user` INT DEFAULT '1',
			`title` VARCHAR(256) DEFAULT '',
			`url` VARCHAR(256) DEFAULT '',
			`img` VARCHAR(256) DEFAULT '',
			`tag` VARCHAR(512) DEFAULT '',
			`param` BLOB DEFAULT '' ".$this->getFullTextInstallStr('galleryitem').",
			INDEX url_index (url(32))
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;
			")) {
			echo 'Table <b>'.$table_name.'</b> is installed<br />';
			} else {
				echo 'Table <b>'.$table_name.'</b> <b>is not</b> installed<br />';
				}
		
		
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'access_feedback','right_name'=>'Доступ к обратной связи'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_feedback_add','right_name'=>'Добавление записей в обратную связь'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_feedback_delete','right_name'=>'Удаление записей в обратной связи'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_feedback_edit','right_name'=>'Редактирование записей в обратной связи'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_feedback_superuser','right_name'=>'Широкие возможности работы с обратной связью'));
		
		$table_name=$this->FE->DB->dbtables['t_feedback'];
		if($this->FE->DB->dbQuery("CREATE TABLE IF NOT EXISTS `$table_name` (
			`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`created_at` INT DEFAULT '0',
			`profile` INT DEFAULT '0',
			`visible` INT DEFAULT '1',
			`view_as` VARCHAR(64) DEFAULT '',
			`phone` VARCHAR(64) DEFAULT '',
			`email` VARCHAR(64) DEFAULT '',
			`main_info` TEXT DEFAULT '',
			`param` BLOB DEFAULT '' ".$this->getFullTextInstallStr('feedback')."
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;
			")) {
			echo 'Table <b>'.$table_name.'</b> is installed<br />';
			} else {
				echo 'Table <b>'.$table_name.'</b> <b>is not</b> installed<br />';
				}
		
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'access_faq','right_name'=>'Доступ к FAQ'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_faq_add','right_name'=>'Добавление записей в FAQ'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_faq_delete','right_name'=>'Удаление записей в FAQ'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_faq_edit','right_name'=>'Редактирование записей в FAQ'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_faq_superuser','right_name'=>'Широкие возможности работы с FAQ'));
		
		$table_name=$this->FE->DB->dbtables['t_faq'];
		if($this->FE->DB->dbQuery("CREATE TABLE IF NOT EXISTS `$table_name` (
			`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`created_at` INT DEFAULT '0',
			`profile` INT DEFAULT '0',
			`user` INT DEFAULT '0',
			`visible` INT DEFAULT '1',
			`main_info` TEXT DEFAULT '',
			`resp` TEXT DEFAULT '',
			`param` BLOB DEFAULT '' ".$this->getFullTextInstallStr('faq')."
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;
			")) {
			echo 'Table <b>'.$table_name.'</b> is installed<br />';
			} else {
				echo 'Table <b>'.$table_name.'</b> <b>is not</b> installed<br />';
				}
		
		/*
		$table_name=$this->FE->DB->dbtables['t_subscribe'];
		if($this->FE->DB->dbQuery("CREATE TABLE IF NOT EXISTS `$table_name` (
			`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`created_at` int(11) DEFAULT '0',
			`status` INT DEFAULT '1',
			`email` VARCHAR(64) NOT NULL UNIQUE,
			`param` blob DEFAULT ''
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;
			")) {
			echo 'Table <b>'.$table_name.'</b> is installed<br />';
			} else {
				echo 'Table <b>'.$table_name.'</b> <b>is not</b> installed<br />';
				}
		*/
		
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'access_geopoint','right_name'=>'Доступ к геоотметкам'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_geopointcat_edit','right_name'=>'Редактирование категорий геоотметок'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_geopoint_add','right_name'=>'Добавление геоотметок'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_geopoint_delete','right_name'=>'Удаление геоотметок'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_geopoint_edit','right_name'=>'Редактирование геоотметок'));
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array('right_id'=>'change_geopoint_superuser','right_name'=>'Широкие возможности работы с геоотметками'));
		
		$table_name=$this->FE->DB->dbtables['t_geopointcat'];
		if($this->FE->DB->dbQuery("CREATE TABLE IF NOT EXISTS `$table_name` (
			`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`parent` INT DEFAULT '0',
			`visible` INT DEFAULT '1',
			`seo` INT DEFAULT '0',
			`title` VARCHAR(256) DEFAULT '',
			`url` VARCHAR(256) DEFAULT '',
			`img` VARCHAR(256) DEFAULT '',
			`preview` VARCHAR(512) DEFAULT '',
			`param` BLOB DEFAULT '' ".$this->getFullTextInstallStr('cat').",
			INDEX url_index (url(32))
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;
			")) {
			echo 'Table <b>'.$table_name.'</b> is installed<br />';
			} else {
				echo 'Table <b>'.$table_name.'</b> <b>is not</b> installed<br />';
				}
		$table_name=$this->FE->DB->dbtables['t_geopoint'];
		if($this->FE->DB->dbQuery("CREATE TABLE IF NOT EXISTS `$table_name` (
			`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`created_at` INT DEFAULT '0',
			`cat` INT DEFAULT '0',
			`visible` INT DEFAULT '1',
			`seo` INT DEFAULT '0',
			`rating` INT DEFAULT '999999999',
			`user` INT DEFAULT '1',
			`lat` DOUBLE DEFAULT '0',
			`lng` DOUBLE DEFAULT '0',
			`uid` VARCHAR(64) NOT NULL UNIQUE,
			`title` VARCHAR(256) DEFAULT '',
			`url` VARCHAR(256) DEFAULT '',
			`img` VARCHAR(256) DEFAULT '',
			`gal` VARCHAR(256) DEFAULT '',
			`preview` VARCHAR(512) DEFAULT '',
			`tag` VARCHAR(512) DEFAULT '',
			`main_info` MEDIUMTEXT DEFAULT '',
			`filter` BLOB DEFAULT '',
			`param` BLOB DEFAULT '' ".$this->getFullTextInstallStr('item').",
			INDEX url_index (url(32))
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;
			")) {
			echo 'Table <b>'.$table_name.'</b> is installed<br />';
			} else {
				echo 'Table <b>'.$table_name.'</b> <b>is not</b> installed<br />';
				}
		
		$this->FE->go2('/login/');
		
		}
	
	function getFullTextInstallStr($type='')
	{
		$str=', FULLTEXT KEY `ftsearch` ({%fields%})';
		switch($type) {
			
			case 'item': {
				$fields="`title`,`preview`,`tag`,`main_info`";
			}
			break;
			
			case 'cat': {
				$fields="`title`,`preview`";
			}
			break;
			
			case 'feedback': {
				$fields="`main_info`";
			}
			break;
			
			case 'faq': {
				$fields="`main_info`,`resp`";
			}
			break;
			
			case 'galleryitem': {
				$fields="`title`,`tag`";
			}
			break;
			
			default:{
				$fields="`title`,`preview`";
			}
			break;
		}
		/*
		// Раскомментировать эту строку, если надо добавить полнотекстовый поиск к отдельным таблицам
		return strtr($str,array('{%fields%}'=>$fields,));
		*/
		return '';
	}
	
}

?>