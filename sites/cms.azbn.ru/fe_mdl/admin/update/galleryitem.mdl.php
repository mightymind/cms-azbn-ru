<?
$type=$this->FE->c_s($param['req_arr']['param_1']);

$_param=array(	
				);

$param['new_el']=array(
	'gal'=>$this->FE->as_int($_POST['parent']),
	'visible'=>$this->FE->as_int($_POST['visible']),
	'seo'=>$this->FE->as_int($_POST['seo']),
	'rating'=>$this->FE->as_int($_POST['rating']),
	'title'=>$this->FE->_post('title'),
	'url'=>$this->FE->_post('url'),
	'img'=>$this->FE->ch($_POST['img']),
	//'preview'=>$this->FE->_post('preview'),
	'tag'=>$this->FE->_post('tag'),
	//'main_info'=>$this->FE->ch($_POST['main_info']),
	'param'=>serialize($_param)
	);

if($_SESSION['user']['right']['change_gallery_superuser'] && isset($_POST['user'])) {
	$param['new_el']['user']=$this->FE->as_int($_POST['user']);
	}

$this->FE->DB->dbUpdateArr($this->FE->DB->dbtables['t_'.$type],$param['new_el'],"WHERE id='{$param['new_el_id']}'");

$log_id=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_log'],array(
	'created_at'=>$this->FE->date,
	'user'=>$_SESSION['user']['id'],
	'el_id'=>$param['new_el_id'],
	'el_type'=>$type,
	'type'=>'update',
	'param'=>serialize(array())
	));
	
?>