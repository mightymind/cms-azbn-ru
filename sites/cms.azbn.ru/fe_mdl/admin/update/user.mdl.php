<?
$type=$this->FE->c_s($param['req_arr']['param_1']);

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
	'email'=>$this->FE->_post('email'),
	'right'=>$right,
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

if(mb_strlen($_POST['pass'])) {
	//$this->FE->hash('admin')
	$param['new_el']['pass']=$this->FE->hash($this->FE->_post('pass'),$this->FE->_post('login'),$this->FE->version['secret']);//$this->FE->hash($this->FE->_post('pass'));
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

if($this->FE->as_int($param['new_el_id'])===$this->FE->as_int($_SESSION['user']['id'])) {
	$user_id=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_user']."` WHERE id='{$param['new_el_id']}'");
	
	$_SESSION['user']=$user_id;
	$_SESSION['user']['param']=unserialize($user_id['param']);
	$_SESSION['user']['right']=array();
	$right=explode(',',$user_id['right']);
	if(count($right)) {
		foreach($right as $right_id) {
			$_SESSION['user']['right'][$right_id]=1;
			}
		}
	
	}
?>