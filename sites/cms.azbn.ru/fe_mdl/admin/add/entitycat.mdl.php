<?

$type=$this->FE->c_s($param['req_arr']['param_1']);
$entity_id=$this->FE->c_s($param['req_arr']['param_2']);

$param['entity']=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_entity']."` WHERE id='$entity_id'");
$param['entity']['param']=unserialize($param['entity']['param']);

//$table=$this->FE->config['mysql_prefix'].'_'.$param['entity']['url'].'cat';

$param['html_tpl']='admin/add/'.$type;
?>