<?
$param['new_el']=array(
	'created_at'=>$this->FE->date,
	'user'=>$_SESSION['user']['id'],
	'user2'=>$this->FE->as_int($_POST['user2']),
	'status'=>0,
	'rating'=>$this->FE->as_int($_POST['rating']),
	'title'=>$this->_post('title'),
	'main_info'=>$this->ch($_POST['main_info']),
	'param'=>serialize(array())
	);

$param['new_el_id']=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_usertask'],$param['new_el']);

$log_id=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_log'],array(
	'created_at'=>$this->FE->date,
	'user'=>$_SESSION['user']['id'],
	'el_id'=>$param['new_el_id'],
	'el_type'=>'usertask',
	'type'=>'create',
	'param'=>serialize(array())
	));
?>