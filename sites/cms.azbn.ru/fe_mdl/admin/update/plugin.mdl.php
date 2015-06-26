<?
$type=$this->FE->c_s($param['req_arr']['param_1']);

$_param=array();

if(count($_POST['param'])) {
	foreach($_POST['param'] as $name=>$value) {
		$_param[$this->FE->c_s($name)]=$this->FE->c_s($value);
	}
}

$param['new_el']=array(
	'title'=>$this->FE->_post('title'),
	'status'=>$this->FE->as_int($_POST['status']),
	'rating'=>$this->FE->as_int($_POST['rating']),
	'param'=>serialize($_param),
);

$this->FE->DB->dbUpdateArr($this->FE->DB->dbtables['t_'.$type],$param['new_el'],"WHERE id='{$param['new_el_id']}'");

$log_id=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_log'],array(
	'created_at'=>$this->FE->date,
	'user'=>$_SESSION['user']['id'],
	'el_id'=>$param['new_el_id'],
	'el_type'=>$type,
	'type'=>'update',
	'param'=>serialize(array())
	));
	
?>