<?
$param['new_el']=array(
	'status'=>$this->_post('status'),
	'rating'=>$this->_post('rating'),
	'login'=>$this->_post('login'),
	'pass'=>$this->FE->hash($this->_post('pass')),
	'app_key'=>$this->_post('app_key'),
	'param'=>serialize(array())
	);

$this->FE->DB->dbUpdateArr($this->FE->DB->dbtables['t_apiapp'],$param['new_el'],"WHERE id='{$param['new_el_id']}'");

$log_id=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_log'],array(
	'created_at'=>$this->FE->date,
	'user'=>$_SESSION['user']['id'],
	'el_id'=>$param['new_el_id'],
	'el_type'=>'apiapp',
	'type'=>'update',
	'param'=>serialize(array())
	));
?>