<?
$type=$this->FE->c_s($param['req_arr']['param_1']);
$table=$this->FE->DB->dbtables['t_'.$type];
$param['html_tpl']='admin/all/'.$type;

$param['el_list_page']=$this->FE->as_int($_GET['page']);
$pos=$param['el_list_page']*50;
$param['el_list']=$this->FE->DB->dbSelect("SELECT * FROM `$table` ORDER BY id DESC LIMIT $pos,50");

?>