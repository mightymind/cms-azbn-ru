<?
// ЦМС
$type=$this->FE->c_s($param['req_arr']['param_1']);
$id=$param['backup_el']['el_id'];

$param['edit_el']=unserialize(file_get_contents($this->FE->config['backup_path'].'/'.$this->FE->config['site'].'/'.$param['backup_el']['el_type'].'/'.$param['backup_el']['created_at'].'_0_'.$param['backup_el']['el_id'].'_'.$param['backup_el']['user']));
$param['html_tpl']='admin/edit/'.$param['backup_el']['el_type'];

$param['edit_el']['param']=unserialize($param['edit_el']['param']);
$param['edit_el']['right']=explode(',',$param['edit_el']['right']);
			if(count($param['edit_el']['right'])) {
				$right=$param['edit_el']['right'];
				unset($param['edit_el']['right']);
				$param['edit_el']['right']=array();
				foreach($right as $right_id) {
					$param['edit_el']['right'][$right_id]=1;
					}
				}

?>