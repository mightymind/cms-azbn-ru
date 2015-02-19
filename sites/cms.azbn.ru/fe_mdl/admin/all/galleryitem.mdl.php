<?
$type=$this->FE->c_s($param['req_arr']['param_1']);
$table=$this->FE->DB->dbtables['t_'.$type];
$param['html_tpl']='admin/all/'.$type;

if(isset($_GET['parent'])) {
	$param['parent_gal']=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `{$this->FE->DB->dbtables['t_gallery']}` WHERE id='{$this->FE->as_int($_GET['parent'])}'");
	$param['el_list']=$this->FE->DB->dbSelect("SELECT * FROM `$table` WHERE gal='{$this->FE->as_int($_GET['parent'])}' ORDER BY id DESC");
	} elseif(isset($_GET['search'])) {
		$param['search_str']=$this->FE->c_s($_GET['search']);
		$param['el_list']=$this->FE->DB->dbSelect("SELECT * FROM `$table` WHERE (title LIKE '%{$param['search_str']}%') ORDER BY id DESC");
		} else {
			$param['el_list_page']=$this->FE->as_int($_GET['page']);
			$pos=$param['el_list_page']*50;
			$param['el_list']=$this->FE->DB->dbSelect("SELECT * FROM `$table` ORDER BY id DESC LIMIT $pos,50");
			}

?>