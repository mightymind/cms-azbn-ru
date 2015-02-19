<?
// Azbn API - Фреймворк ForEach 2.9

if($this->FE->DB->dbUpdateArr($this->FE->DB->dbtables['t_usertask'],array('status'=>$param['api_resp']['req']['status']),"WHERE id='{$param['api_resp']['req']['id']}'")) {
	$param['api_resp']['info']['info_msg']='Статус задания изменен';
	
	$log_id=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_log'],array(
		'created_at'=>$this->FE->date,
		'user'=>$_SESSION['user']['id'],
		'el_id'=>$param['api_resp']['req']['id'],
		'el_type'=>'usertask',
		'type'=>'update',
		'param'=>serialize(array())
		));
	
	} else {
		$param['api_resp']['info']['info_msg']='Статус задания не изменен';
		}

?>