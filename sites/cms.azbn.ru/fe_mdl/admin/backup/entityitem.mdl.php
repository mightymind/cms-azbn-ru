<?
// ЦМС
$type=$this->FE->c_s($param['req_arr']['param_1']);
$id=$param['backup_el']['el_id'];

if($param['backup_el']['entity']) {
	$param['entity']=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_entity']."` WHERE id='{$param['backup_el']['entity']}'");
	$param['entity']['param']=unserialize($param['entity']['param']);
}

$param['edit_el']=unserialize(file_get_contents($this->FE->config['backup_path'].'/'.$this->FE->config['site'].'/'.$param['backup_el']['el_type'].'/'.$param['backup_el']['created_at'].'_'.$param['backup_el']['entity'].'_'.$param['backup_el']['el_id'].'_'.$param['backup_el']['user']));
$param['html_tpl']='admin/edit/'.$param['backup_el']['el_type'];

$param['edit_el']['param']=unserialize($param['edit_el']['param']);

?>