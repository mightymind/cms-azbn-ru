<?

$type=$this->FE->c_s($param['req_arr']['param_1']);

$_param=array(	
				);

$param['new_el']=array(
	'parent'=>$this->FE->as_int($_POST['parent']),
	'visible'=>$this->FE->as_int($_POST['visible']),
	'title'=>$this->FE->_post('title'),
	'img'=>$this->FE->ch($_POST['img']),
	'preview'=>$this->FE->_post('preview'),
	'param'=>serialize($_param)
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