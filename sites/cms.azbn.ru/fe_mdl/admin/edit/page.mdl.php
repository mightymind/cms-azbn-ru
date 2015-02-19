<?
// ЦМС
$type=$this->FE->c_s($param['req_arr']['param_1']);
$id=$this->FE->as_int($param['req_arr']['param_2']);

$table=$this->FE->DB->dbtables['t_'.$type];
$param['html_tpl']='admin/edit/'.$type;
$param['edit_el']=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `$table` WHERE (id='$id')");
$param['edit_el']['param']=unserialize($param['edit_el']['param']);
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

?>