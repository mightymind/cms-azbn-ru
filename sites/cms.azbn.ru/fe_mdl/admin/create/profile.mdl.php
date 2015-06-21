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

//$_param=array();

$param['new_el']=array(
	'seo'=>$this->FE->as_int($_POST['seo']),
	'rating'=>$this->FE->as_int($_POST['rating']),
	'cash'=>$this->FE->as_int($_POST['cash']),
	'login'=>$this->FE->_post('login'),
	'pass'=>$this->FE->hash($this->FE->_post('pass'),$this->FE->_post('login'),'profile'),//$this->FE->hash($this->FE->_post('pass')),
	'email'=>$this->FE->_post('email'),
	'view_as'=>$this->FE->_post('view_as'),
	'img'=>$this->FE->ch($_POST['img']),
	'filter'=>$_filter,
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
		'timezone'=>$this->FE->_post('timezone'),
		)),
	);

if($_SESSION['user']['right']['change_profile_block'] && isset($_POST['status'])) {
	$param['new_el']['status']=$this->FE->as_int($_POST['status']);
	} else {
		
		}

$param['new_el_id']=$this->FE->DB->dbInsertIgnore($this->FE->DB->dbtables['t_'.$type],$param['new_el']);

$log_id=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_log'],array(
	'created_at'=>$this->FE->date,
	'user'=>$_SESSION['user']['id'],
	'el_id'=>$param['new_el_id'],
	'el_type'=>$type,
	'type'=>'create',
	'param'=>serialize(array())
	));
	
?>