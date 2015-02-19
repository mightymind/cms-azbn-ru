<?
$type=$this->FE->c_s($param['req_arr']['param_1']);

$param['new_el']=array(
	'title'=>$this->FE->_post('title'),
	'desc'=>$this->FE->_post('desc'),
	'kw'=>$this->FE->_post('kw'),
	);

$this->DB->dbUpdateArr($this->DB->dbtables['t_'.$type],$param['new_el'],"WHERE id='{$param['new_el_id']}'");

$log_id=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_log'],array(
	'created_at'=>$this->FE->date,
	'user'=>$_SESSION['user']['id'],
	'el_id'=>$param['new_el_id'],
	'el_type'=>$type,
	'type'=>'update',
	'param'=>serialize(array())
	));
?>