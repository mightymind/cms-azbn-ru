<?
// Azbn API - Фреймворк ForEach 2.9

$userright_id=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_userright'],array(
	'right_id'=>$param['api_resp']['req']['id'],
	'right_name'=>$param['api_resp']['req']['name']
	));

if($userright_id &&	$_SESSION['user']['right']['change_userright_structure']) {
	$param['api_resp']['info']['info_msg']='Уровнь доступа создан';
	
	$log_id=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_log'],array(
		'created_at'=>$this->FE->date,
		'user'=>$_SESSION['user']['id'],
		'el_id'=>$userright_id,
		'el_type'=>'userright',
		'type'=>'create',
		'param'=>serialize(array())
		));
	
	} else {
		$param['api_resp']['info']['info_msg']='Уровнь доступа не создан';
		}

?>