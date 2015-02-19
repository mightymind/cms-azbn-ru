<?
$param['new_el']=array(
	'user2'=>$this->FE->as_int($_POST['user2']),
	'status'=>$this->FE->as_int($_POST['status']),
	'rating'=>$this->FE->as_int($_POST['rating']),
	'title'=>$this->_post('title'),
	'main_info'=>$this->ch($_POST['main_info']),
	'param'=>serialize(array())
	);

$this->DB->dbUpdateArr($this->DB->dbtables['t_usertask'],$param['new_el'],"WHERE id='{$param['new_el_id']}'");

$log_id=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_log'],array(
	'created_at'=>$this->FE->date,
	'user'=>$_SESSION['user']['id'],
	'el_id'=>$param['new_el_id'],
	'el_type'=>'usertask',
	'type'=>'update',
	'param'=>serialize(array())
	));
?>