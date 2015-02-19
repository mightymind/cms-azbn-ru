<?
$type=$this->FE->c_s($param['req_arr']['param_1']);
$table=$this->FE->DB->dbtables['t_'.$type];
$param['html_tpl']='admin/all/'.$type;

$table_user=$this->FE->DB->dbtables['t_user'];

if(isset($_GET['search'])) {
	$param['search_str']=$this->FE->c_s($_GET['search']);
	$param['el_list']=$this->FE->DB->dbSelect("SELECT $table.*, $table_user.view_as AS user_view_as FROM `$table`,`$table_user` WHERE ($table.title LIKE '%{$param['search_str']}%' AND $table.user=$table_user.id) ORDER BY $table.size, $table.id");
	} else {
		$param['el_list_page']=$this->FE->as_int($_GET['page']);
		$pos=$param['el_list_page']*50;
		$param['el_list']=$this->FE->DB->dbSelect("SELECT $table.*, $table_user.view_as AS user_view_as FROM `$table`,`$table_user` WHERE ($table.user=$table_user.id) ORDER BY $table.id DESC LIMIT $pos,50");
		}

?>