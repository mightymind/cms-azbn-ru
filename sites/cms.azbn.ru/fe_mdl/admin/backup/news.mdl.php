<?
// ЦМС
$type=$this->FE->c_s($param['req_arr']['param_1']);
$id=$param['backup_el']['el_id'];

$param['edit_el']=unserialize(file_get_contents($this->FE->config['backup_path'].'/'.$this->FE->config['site'].'/'.$param['backup_el']['el_type'].'/'.$param['backup_el']['created_at'].'_0_'.$param['backup_el']['el_id'].'_'.$param['backup_el']['user']));
$param['html_tpl']='admin/edit/'.$param['backup_el']['el_type'];

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