<?
$param['new_el']=array(
	'status'=>$this->_post('status'),
	'rating'=>$this->_post('rating'),
	'login'=>$this->_post('login'),
	'pass'=>$this->FE->hash($this->FE->hash($this->_post('login'))),
	'app_key'=>$this->FE->hash($this->FE->date.'_'.$this->_post('login')),
	'param'=>serialize(array())
	);

$param['new_el_id']=$this->DB->dbInsert($this->DB->dbtables['t_apiapp'],$param['new_el']);

$log_id=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_log'],array(
	'created_at'=>$this->FE->date,
	'user'=>$_SESSION['user']['id'],
	'el_id'=>$param['new_el_id'],
	'el_type'=>'apiapp',
	'type'=>'create',
	'param'=>serialize(array())
	));
?>