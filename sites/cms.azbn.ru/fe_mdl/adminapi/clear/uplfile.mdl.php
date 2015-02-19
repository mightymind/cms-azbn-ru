<?
// Azbn API - Фреймворк ForEach 2.9

if($this->FE->DB->dbQuery("TRUNCATE TABLE `{$this->FE->DB->dbtables['t_uplfile']}`")) {
	$param['api_resp']['info']['info_msg']='Таблица загрузок файлов очищена';
	
	$log_id=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_log'],array(
		'created_at'=>$this->FE->date,
		'user'=>$_SESSION['user']['id'],
		'el_id'=>0,
		'el_type'=>'uplfile',
		'type'=>'clear',
		'param'=>serialize(array())
		));
	
	} else {
		$param['api_resp']['info']['info_msg']='Таблица загрузок файлов не очищена';
		}

?>