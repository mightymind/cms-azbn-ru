<?

$type=$this->FE->c_s($param['req_arr']['param_1']);

$_filter=array();
if(is_array($_POST['filter']) && count($_POST['filter'])) {
	foreach($_POST['filter'] as $fid=>$fval) {
		if($this->FE->as_int($fval)) {
			$_filter[]="|$fid|";
			}
		}
	}
$_filter=implode(',',$_filter);

$_param=array(	
				);

$param['new_el']=array(
	'parent'=>$this->FE->as_int($_POST['parent']),
	'visible'=>$this->FE->as_int($_POST['visible']),
	'seo'=>$this->FE->as_int($_POST['seo']),
	'w'=>$this->FE->as_int($_POST['w']),
	'h'=>$this->FE->as_int($_POST['h']),
	'crop'=>$this->FE->as_int($_POST['crop']),
	'title'=>$this->FE->_post('title'),
	'url'=>$this->FE->_post('url'),
	'img'=>$this->FE->ch($_POST['img']),
	'preview'=>$this->FE->_post('preview'),
	'filter'=>$_filter,
	'param'=>serialize($_param)
	);

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