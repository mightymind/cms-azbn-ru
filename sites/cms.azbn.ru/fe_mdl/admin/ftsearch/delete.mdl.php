<?
$type=$this->FE->c_s($param['req_arr']['param_1']);
$id=$this->FE->c_s($param['req_arr']['param_2']);

$this->FE->DB->dbDelete($this->FE->DB->dbtables['t_ftsearch'],"WHERE el_id='$id' AND el_type='$type'");

$log_id=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_log'],array(
		'created_at'=>$this->FE->date,
		'user'=>$_SESSION['user']['id'],
		'el_id'=>$id,
		'el_type'=>$type,
		'type'=>'fulltext_delete',
		'param'=>serialize(array()),
		));
	
?>