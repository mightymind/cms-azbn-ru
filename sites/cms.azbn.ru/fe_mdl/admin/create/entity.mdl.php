<?
$type=$this->FE->c_s($param['req_arr']['param_1']);

$_param=array(
	'field'=>array(
		'cat'=>array(
			'img'=>$this->FE->as_int($_POST['cat']['img']),
			'preview'=>$this->FE->as_int($_POST['cat']['preview']),
			//'filter'=>$this->FE->as_int($_POST['cat']['filter']),
			'main_info'=>$this->FE->as_int($_POST['cat']['main_info']),
			),
		'item'=>array(
			'rating'=>$this->FE->as_int($_POST['item']['rating']),
			'uid'=>$this->FE->as_int($_POST['item']['uid']),
			'oldcost'=>$this->FE->as_int($_POST['item']['oldcost']),
			'cost'=>$this->FE->as_int($_POST['item']['cost']),
			'count'=>$this->FE->as_int($_POST['item']['count']),
			'view_as'=>$this->FE->as_int($_POST['item']['view_as']),
			'img'=>$this->FE->as_int($_POST['item']['img']),
			'preview'=>$this->FE->as_int($_POST['item']['preview']),
			'tag'=>$this->FE->as_int($_POST['item']['tag']),
			'gal'=>$this->FE->as_int($_POST['item']['gal']),
			'main_info'=>$this->FE->as_int($_POST['item']['main_info']),
			'filter'=>$this->FE->as_int($_POST['item']['filter']),
			'yt_video'=>$this->FE->as_int($_POST['item']['yt_video']),
			'coord'=>$this->FE->as_int($_POST['item']['coord']),
			'start_at'=>$this->FE->as_int($_POST['item']['start_at']),
			'stop_at'=>$this->FE->as_int($_POST['item']['stop_at']),
			'profile'=>$this->FE->as_int($_POST['item']['profile']),
			),
		),
	);

$param['new_el']=array(
	'ftsearch'=>$this->FE->as_int($_POST['ftsearch']),
	'title'=>$this->FE->_post('title'),
	'url'=>$this->FE->_post('url'),
	//'urlcat'=>$this->FE->_post('url').'cat',
	'param'=>serialize($_param),
	);

$param['new_el_id']=$this->FE->DB->dbInsertIgnore($this->FE->DB->dbtables['t_'.$type],$param['new_el']);

if($param['new_el_id']) {
	/*
	$_param_str=array();
	foreach($_param['field'] as $name=>$arr) {
		foreach($arr as $param=>$value) {
			$_param_str[$name][$param]
		}
	}
	*/
	$_param_str['cat']['img']=$_param['field']['cat']['img']?"`img` VARCHAR(256) DEFAULT '',":'';
	$_param_str['cat']['preview']=$_param['field']['cat']['preview']?"`preview` VARCHAR(512) DEFAULT '',":'';
	//$_param_str['cat']['filter']=$_param['field']['cat']['filter']?"`preview` VARCHAR(512) DEFAULT '',":'';
	$_param_str['cat']['main_info']=$_param['field']['cat']['main_info']?"`main_info` MEDIUMTEXT DEFAULT '',":'';
	
	
	$_param_str['item']['rating']=$_param['field']['item']['rating']?"`rating` INT DEFAULT '999999999',":'';
	$_param_str['item']['uid']=$_param['field']['item']['uid']?"`uid` VARCHAR(64) NOT NULL UNIQUE,":'';
	$_param_str['item']['oldcost']=$_param['field']['item']['oldcost']?"`oldcost` DOUBLE DEFAULT '0',":'';
	$_param_str['item']['cost']=$_param['field']['item']['cost']?"`cost` DOUBLE DEFAULT '0',":'';
	$_param_str['item']['count']=$_param['field']['item']['count']?"`count` INT DEFAULT '0',":'';
	$_param_str['item']['view_as']=$_param['field']['item']['view_as']?"`view_as` VARCHAR(128) DEFAULT '',":'';
	$_param_str['item']['img']=$_param['field']['item']['img']?"`img` VARCHAR(256) DEFAULT '',":'';
	$_param_str['item']['preview']=$_param['field']['item']['preview']?"`preview` VARCHAR(512) DEFAULT '',":'';
	$_param_str['item']['tag']=$_param['field']['item']['tag']?"`tag` VARCHAR(512) DEFAULT '',":'';
	$_param_str['item']['gal']=$_param['field']['item']['gal']?"`gal` VARCHAR(256) DEFAULT '',":'';
	$_param_str['item']['main_info']=$_param['field']['item']['main_info']?"`main_info` MEDIUMTEXT DEFAULT '',":'';
	$_param_str['item']['filter']=$_param['field']['item']['filter']?"`filter` BLOB DEFAULT '',":'';
	//$_param_str['item']['yt_video']=$_param['field']['item']['yt_video']?",":'';
	if($_param['field']['item']['coord']) {
		$_param_str['item']['lat']="`lat` DOUBLE DEFAULT '0',";
		$_param_str['item']['lng']="`lng` DOUBLE DEFAULT '0',";
	} else {
		$_param_str['item']['lat']='';
		$_param_str['item']['lng']='';
	}
	$_param_str['item']['start_at']=$_param['field']['item']['start_at']?"`start_at` INT DEFAULT '0',":'';
	$_param_str['item']['stop_at']=$_param['field']['item']['stop_at']?"`stop_at` INT DEFAULT '0',":'';
	$_param_str['item']['profile']=$_param['field']['item']['profile']?"`profile` INT DEFAULT '0',":'';
	
	$table_name=$this->FE->config['mysql_prefix'].'_'.$param['new_el']['url'].'cat';
		if($this->FE->DB->dbQuery("CREATE TABLE IF NOT EXISTS `$table_name` (
			`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`parent` INT DEFAULT '0',
			`visible` INT DEFAULT '1',
			`seo` INT DEFAULT '0',
			`title` VARCHAR(256) DEFAULT '',
			`url` VARCHAR(256) DEFAULT '',
			{$_param_str['cat']['img']}
			{$_param_str['cat']['preview']}
			{$_param_str['cat']['main_info']}
			`param` BLOB DEFAULT '',
			INDEX url_index (url(32))
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;
			")) {
			echo 'Table <b>'.$table_name.'</b> is installed<br />';
			} else {
				echo 'Table <b>'.$table_name.'</b> <b>is not</b> installed<br />';
				}
	
	$table_name=$this->FE->config['mysql_prefix'].'_'.$param['new_el']['url'];
		if($this->FE->DB->dbQuery("CREATE TABLE IF NOT EXISTS `$table_name` (
			`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`created_at` INT DEFAULT '0',
			`cat` INT DEFAULT '0',
			`visible` INT DEFAULT '1',
			`seo` INT DEFAULT '0',
			{$_param_str['item']['start_at']}
			{$_param_str['item']['stop_at']}
			{$_param_str['item']['rating']}
			`user` INT DEFAULT '1',
			{$_param_str['item']['profile']}
			{$_param_str['item']['count']}
			{$_param_str['item']['cost']}
			{$_param_str['item']['oldcost']}
			{$_param_str['item']['lat']}
			{$_param_str['item']['lng']}
			{$_param_str['item']['uid']}
			{$_param_str['item']['view_as']}
			`title` VARCHAR(256) DEFAULT '',
			`url` VARCHAR(256) DEFAULT '',
			{$_param_str['item']['img']}
			{$_param_str['item']['gal']}
			{$_param_str['item']['preview']}
			{$_param_str['item']['tag']}
			{$_param_str['item']['main_info']}
			{$_param_str['item']['filter']}
			`param` BLOB DEFAULT '',
			INDEX url_index (url(32))
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;
			")) {
			echo 'Table <b>'.$table_name.'</b> is installed<br />';
			} else {
				echo 'Table <b>'.$table_name.'</b> <b>is not</b> installed<br />';
				}
	
	$log_id=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_log'],array(
	'created_at'=>$this->FE->date,
	'user'=>$_SESSION['user']['id'],
	'el_id'=>$param['new_el_id'],
	'el_type'=>$type,
	'type'=>'create',
	'param'=>serialize(array())
	));
}
?>