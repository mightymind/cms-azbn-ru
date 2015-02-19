<?
// ЦМС
$type=$this->FE->c_s($param['req_arr']['param_1']);
$entity_id=$this->FE->c_s($param['req_arr']['param_2']);
$id=$this->FE->as_int($param['req_arr']['param_3']);

$param['entity']=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_entity']."` WHERE id='$entity_id'");
$param['entity']['param']=unserialize($param['entity']['param']);

$table=$this->FE->config['mysql_prefix'].'_'.$param['entity']['url'];

$param['html_tpl']='admin/edit/'.$type;
$param['edit_el']=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `$table` WHERE (id='$id')");
$param['edit_el']['param']=unserialize($param['edit_el']['param']);

if($param['entity']['param']['field']['item']['filter']) {
$param['edit_el']['filter']=explode(',',strtr($param['edit_el']['filter'],array('|'=>'')));
if(count($param['edit_el']['filter'])) {
	$_filter=array();
	foreach($param['edit_el']['filter'] as $flt) {
		$_filter[$flt]=1;
		}
	$param['edit_el']['filter']=$_filter;
	} else {
		$param['edit_el']['filter']=array();
		}
}

?>