<?
$type=$this->FE->c_s($param['req_arr']['param_1']);

$_param=array(
				);

$param['new_el']=array(
	'created_at'=>strtotime($this->FE->_post('date').' '.$this->FE->_post('time')),//$this->FE->date,
	'profile'=>$this->FE->as_int($_POST['profile']),
	'user'=>$_SESSION['user']['id'],
	'visible'=>$this->FE->as_int($_POST['visible']),
	'main_info'=>$this->FE->ch($_POST['main_info']),
	'resp'=>$this->FE->ch($_POST['resp']),
	'param'=>serialize($_param)
	);

$param['new_el_id']=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_'.$type],$param['new_el']);

$log_id=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_log'],array(
	'created_at'=>$this->FE->date,
	'user'=>$_SESSION['user']['id'],
	'el_id'=>$param['new_el_id'],
	'el_type'=>$type,
	'type'=>'create',
	'param'=>serialize(array())
	));
?>