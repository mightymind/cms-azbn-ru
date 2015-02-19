<?

$type=$this->FE->c_s($param['req_arr']['param_1']);

$_param=array(	
				);

$param['new_el']=array(
	'ftsearch'=>$this->FE->as_int($_POST['ftsearch']),
	'title'=>$this->FE->_post('title'),
	'url'=>$this->FE->_post('url'),
	'param'=>serialize($_param)
	);

$this->FE->DB->dbUpdateArr($this->FE->DB->dbtables['t_'.$type],$param['new_el'],"WHERE id='{$param['new_el_id']}'");

$this->FE->DB->dbUpdateArr($this->FE->DB->dbtables['t_ftsearch'], array('visible'=>$param['new_el']['ftsearch'],),"WHERE entity='{$param['new_el_id']}'");
//$this->FE->DB->dbDelete($this->FE->DB->dbtables['t_ftsearch'],"WHERE entity='{$param['new_el_id']}'");

$log_id=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_log'],array(
	'created_at'=>$this->FE->date,
	'user'=>$_SESSION['user']['id'],
	'el_id'=>$param['new_el_id'],
	'el_type'=>$type,
	'type'=>'update',
	'param'=>serialize(array())
	));
?>