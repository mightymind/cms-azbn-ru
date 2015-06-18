<?
$type=$this->FE->c_s($param['req_arr']['param_1']);

$json_str = file_get_contents($this->FE->_post('url'));
$json = json_decode($json_str, true);
//var_dump($json);die();
//$json['param'] = json_decode($json['param'], true);
//echo $json['param'];die();
if(isset($json['url'])) {
	
	$param['new_el'] = array(
		'azbn_id'=>$json['azbn_id'],
		'azbn_cat'=>$json['azbn_cat'],
		'status'=>$json['status'],
		'created_at'=>$this->FE->date,
		'rating'=>$json['rating'],
		'uid'=>$json['uid'],
		'tag'=>$json['tag'],
		'title'=>$json['title'],
		'preview'=>$json['preview'],
		'event'=>$json['event'],
		'param'=>serialize($json['param']),
		);
	
	$param['new_el_id'] = $this->FE->DB->dbInsert($this->FE->DB->dbtables['t_plugin'], $param['new_el']);
	$param['new_el']['id']=$param['new_el_id'];
	
	$log_id=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_log'],array(
		'created_at'=>$this->FE->date,
		'user'=>$_SESSION['user']['id'],
		'el_id'=>$param['new_el_id'],
		'el_type'=>$type,
		'type'=>'create',
		'param'=>serialize(array())
		));
	
	if($param['new_el_id']) {
		$path = 'sites/'.$this->FE->config['site'].'/plugin/'.$param['new_el_id'];
		@mkdir($path, 0755);
		$install_pkg = $path.'/'.basename($this->FE->_post('url'));
		@copy($this->FE->_post('url'), $install_pkg);
		$file = $path.'/main.plugin.php';
		@copy($json['url'], $file);
		if(isset($this->FE->PluginMng)) {
			$this->FE->PluginMng->loadPlugins($param['new_el']['tag'], false);
			if($this->FE->PluginMng->load($param['new_el'])) {
				if(method_exists($this->FE->PluginMng->plugins[$param['new_el_id']], 'install')) {
					$this->FE->PluginMng->plugins[$param['new_el_id']]->install($param);
				}
			}
		}
	}
}

?>