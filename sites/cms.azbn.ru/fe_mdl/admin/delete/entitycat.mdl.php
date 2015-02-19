<?

$type=$this->FE->c_s($param['req_arr']['param_1']);
$entity_id=$this->FE->c_s($param['req_arr']['param_2']);
$id=$this->FE->as_int($param['req_arr']['param_3']);

$param['entity']=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_entity']."` WHERE id='$entity_id'");
$param['entity']['param']=unserialize($param['entity']['param']);

$table=$this->FE->config['mysql_prefix'].'_'.$param['entity']['url'].'cat';

$this->FE->DB->dbDelete($table,"WHERE id='$id'");

$log_id=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_log'],array(
	'created_at'=>$this->FE->date,
	'user'=>$_SESSION['user']['id'],
	'el_id'=>$id,
	'el_type'=>$type,
	'type'=>'delete',
	'param'=>serialize(array())
	));
		
$param['new_el_result']=array();

?>