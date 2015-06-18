<?

$type=$this->FE->c_s($param['req_arr']['param_1']);

$plugin=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_'.$type]."` WHERE id='{$param['new_el_id']}'");
if($plugin['id']) {
	
	//$this->FE->PluginMng->loadPlugins('',false);
	//$this->FE->Pluginmng->plugins[$plugin['id']]->uninstall($param);
	
	if(isset($this->FE->PluginMng)) {
		if($this->FE->PluginMng->load($plugin)) {
			if(method_exists($this->FE->PluginMng->plugins[$plugin['id']], 'uninstall')) {
				$this->FE->PluginMng->plugins[$plugin['id']]->uninstall($param);
			}
			$this->FE->PluginMng->unload($plugin['id']);
			$this->FE->PluginMng->removePluginDirectory($this->FE->PluginMng->getPluginDirectory($plugin['id']));
		}
	}
	
	$this->FE->DB->dbDelete($this->FE->DB->dbtables['t_'.$type],"WHERE id='{$param['new_el_id']}'");

	$log_id=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_log'],array(
		'created_at'=>$this->FE->date,
		'user'=>$_SESSION['user']['id'],
		'el_id'=>$param['new_el_id'],
		'el_type'=>$type,
		'type'=>'delete',
		'param'=>serialize(array())
		));
}
		
$param['new_el_result']=array();

?>