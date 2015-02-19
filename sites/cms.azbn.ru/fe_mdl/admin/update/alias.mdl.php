<?
$type=$this->FE->c_s($param['req_arr']['param_1']);

$param['new_el']=array(
	'sure'=>$this->FE->as_int($_POST['sure']),
	'type'=>$this->FE->_post('type'),
	'req'=>$this->FE->_post('req'),
	'to'=>$this->FE->_post('to'),
	);

$this->FE->DB->dbUpdateArr($this->FE->DB->dbtables['t_'.$type],$param['new_el'],"WHERE id='{$param['new_el_id']}'");

$alias_arr=array(
	'list'=>array(),
	'sure'=>array(),
	'similar'=>array(),
	);
$alias=$this->FE->DB->dbSelect("SELECT * FROM `".$this->FE->DB->dbtables['t_alias']."` ORDER BY sure DESC, id");
while($row=mysql_fetch_array($alias)) {
	$alias_arr['list'][$row['req']]=array(
		'id'=>$this->FE->as_int($row['id']),
		'sure'=>$this->FE->as_int($row['sure']),
		'type'=>$row['type'],
		'req'=>$row['req'],
		'to'=>$row['to'],
		);
	if($row['sure']) {
		$alias_arr['sure'][$row['req']]=&$alias_arr['list'][$row['req']]['to'];
	} else {
		$alias_arr['similar'][$row['req']]=&$alias_arr['list'][$row['req']]['to'];
	}
}
$this->FE->CMS->setParamValue('cms_alias_array',serialize($alias_arr));
$this->FE->config['alias']=$this->FE->CMS->getParamValueAsArr('cms_alias_array');

$log_id=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_log'],array(
	'created_at'=>$this->FE->date,
	'user'=>$_SESSION['user']['id'],
	'el_id'=>$param['new_el_id'],
	'el_type'=>$type,
	'type'=>'update',
	'param'=>serialize(array())
	));
?>