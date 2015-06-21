<?
$param['new_el']=array(
	'view_at'=>$this->FE->as_int($_POST['view_at']),
	'rating'=>$this->FE->as_int($_POST['rating']),
	'img'=>$this->ch($_POST['img']),
	'url'=>$this->ch($_POST['url']),
	'title'=>$this->_post('title'),
	);

$param['new_el_id']=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_banner'],$param['new_el']);

$log_id=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_log'],array(
	'created_at'=>$this->FE->date,
	'user'=>$_SESSION['user']['id'],
	'el_id'=>$param['new_el_id'],
	'el_type'=>'banner',
	'type'=>'create',
	'param'=>serialize(array())
	));
?>