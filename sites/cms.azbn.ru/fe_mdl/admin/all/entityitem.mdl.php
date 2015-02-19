<?
$type=$this->FE->c_s($param['req_arr']['param_1']);
$entity_id=$this->FE->c_s($param['req_arr']['param_2']);

$param['entity']=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_entity']."` WHERE id='$entity_id'");
$param['entity']['param']=unserialize($param['entity']['param']);

$table=$this->FE->config['mysql_prefix'].'_'.$param['entity']['url'];
$param['html_tpl']='admin/all/'.$type;

if(isset($_GET['search'])) {
	$param['search_str']=$this->FE->c_s($_GET['search']);
	$preview_str=$param['entity']['param']['field']['item']['preview']?"OR preview LIKE '%{$param['search_str']}%'":'';
	$param['el_list']=$this->FE->DB->dbSelect("SELECT * FROM `$table` WHERE (title LIKE '%{$param['search_str']}%' $preview_str) ORDER BY title");
	} else {
		$param['el_list_page']=$this->FE->as_int($_GET['page']);
		$pos=$param['el_list_page']*50;
		$param['el_list']=$this->FE->DB->dbSelect("SELECT * FROM `$table` ORDER BY id DESC LIMIT $pos,50");
		}

?>