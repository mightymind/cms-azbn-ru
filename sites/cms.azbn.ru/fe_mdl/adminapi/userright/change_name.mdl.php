<?
// Azbn API - Фреймворк ForEach 2.9

if($this->FE->DB->dbUpdateArr($this->FE->DB->dbtables['t_userright'],array('right_name'=>$param['api_resp']['req']['name']),"WHERE right_id='{$param['api_resp']['req']['id']}'") && $_SESSION['user']['right']['change_userright_structure']) {
	$param['api_resp']['info']['info_msg']='Название уровня доступа изменено';
	
	
	$ur=$this->FE->DB->dbSelectFirstRow("SELECT id FROM `".$this->FE->DB->dbtables['t_userright']."` WHERE right_id='{$param['api_resp']['req']['id']}'");
	
	$log_id=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_log'],array(
		'created_at'=>$this->FE->date,
		'user'=>$_SESSION['user']['id'],
		'el_id'=>$ur['id'],
		'el_type'=>'userright',
		'type'=>'update',
		'param'=>serialize(array())
		));
	
	} else {
		$param['api_resp']['info']['info_msg']='Название уровня доступа не изменено';
		}

?>