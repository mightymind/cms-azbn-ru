<?

$type=$this->FE->c_s($param['req_arr']['param_1']);

$this->FE->DB->dbDelete($this->FE->DB->dbtables['t_'.$type],"WHERE id='{$param['new_el_id']}'");

$log_id=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_log'],array(
	'created_at'=>$this->FE->date,
	'user'=>$_SESSION['user']['id'],
	'el_id'=>$param['new_el_id'],
	'el_type'=>$type,
	'type'=>'delete',
	'param'=>serialize(array())
	));
		
$param['new_el_result']=array();

?>