<?
$type=$this->FE->c_s($param['req_arr']['param_1']);
$entity_id=$this->FE->c_s($param['req_arr']['param_2']);

$param['entity']=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_entity']."` WHERE id='$entity_id'");
$param['entity']['param']=unserialize($param['entity']['param']);

$table=$this->FE->config['mysql_prefix'].'_'.$param['entity']['url'].'cat';

$_param=array(
				);

$param['new_el']=array(
	'parent'=>$this->FE->as_int($_POST['parent']),
	'visible'=>$this->FE->as_int($_POST['visible']),
	'seo'=>$this->FE->as_int($_POST['seo']),
	'title'=>$this->FE->_post('title'),
	'url'=>$this->FE->_post('url'),
	'param'=>serialize($_param),
	);

if($param['entity']['param']['field']['cat']['img']) {
	$param['new_el']['img']=$this->FE->ch($_POST['img']);
}
if($param['entity']['param']['field']['cat']['preview']) {
	$param['new_el']['preview']=$this->FE->_post('preview');
}
if($param['entity']['param']['field']['cat']['main_info']) {
	$param['new_el']['main_info']=$this->FE->ch($_POST['main_info']);
}

$param['new_el_id']=$this->FE->DB->dbInsert($table,$param['new_el']);

$log_id=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_log'],array(
	'created_at'=>$this->FE->date,
	'user'=>$_SESSION['user']['id'],
	'el_id'=>$param['new_el_id'],
	'el_type'=>$type.'.'.$entity_id,
	'type'=>'create',
	'param'=>serialize(array())
	));
?>