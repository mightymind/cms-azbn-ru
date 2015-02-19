<?
// ЦМС
$type=$this->FE->c_s($param['req_arr']['param_1']);
$id=$this->FE->as_int($param['req_arr']['param_2']);

$table=$this->FE->DB->dbtables['t_'.$type];
$param['html_tpl']='admin/edit/'.$type;
$param['edit_el']=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `$table` WHERE (id='$id')");
$param['edit_el']['param']=unserialize($param['edit_el']['param']);

?>