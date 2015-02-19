<?
$right=array();
if(count($_POST['right'])) {
	foreach($_POST['right'] as $k=>$v) {
		if($v) {
			$right[]=$k;
			}
		}
	}
$right=implode(',',$right);

$param['new_el']=array(
	'login'=>$this->FE->_post('login'),
	'view_as'=>$this->FE->_post('view_as'),
	'img'=>$this->ch($_POST['img']),
	'right'=>$right,
	'status'=>1,
	'rating'=>999999999,
	'cash'=>1,
	'pass'=>$this->FE->hash($this->FE->_post('pass'),$this->FE->_post('login'),$this->FE->version['secret']),//$this->FE->hash($this->FE->_post('pass')),
	'email'=>$this->FE->_post('email'),
	'param'=>serialize(array(
		'url'=>$this->FE->ch($_POST['url']),
		'vk'=>array(
			'url'=>$this->FE->ch($_POST['vk_url']),
			),
		'twitter'=>array(
			'url'=>$this->FE->ch($_POST['twitter_url']),
			),
		'email'=>$this->FE->_post('email'),
		'adr'=>$this->FE->_post('adr'),
		'phone'=>$this->FE->_post('phone'),
		'default_editor'=>$this->FE->_post('default_editor'),
		'timezone'=>$this->FE->_post('timezone'),
		)),
	);

$param['new_el_id']=$this->FE->DB->dbInsertIgnore($this->FE->DB->dbtables['t_user'],$param['new_el']);

$log_id=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_log'],array(
	'created_at'=>$this->FE->date,
	'user'=>$_SESSION['user']['id'],
	'el_id'=>$param['new_el_id'],
	'el_type'=>'user',
	'type'=>'create',
	'param'=>serialize(array())
	));

?>