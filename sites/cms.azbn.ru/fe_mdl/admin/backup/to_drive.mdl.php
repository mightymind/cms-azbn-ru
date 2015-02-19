<?
$type=$this->FE->c_s($param['req_arr']['param_1']);

switch($type) {
	
	case 'entityitem':
	case 'entitycat':{
		$entity_id=$this->FE->as_int($param['req_arr']['param_2']);
		$id=$this->FE->as_int($param['req_arr']['param_3']);
		
		$param['entity']=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_entity']."` WHERE id='$entity_id'");
		$param['entity']['id']=$this->FE->as_int($param['entity']['id']);
		
		$table=$this->FE->config['mysql_prefix'].'_'.$param['entity']['url'].($type=='entitycat'?'cat':'');
		
		$file=$this->FE->config['backup_path'].'/'.$this->FE->config['site'].'/'.$type.'/'.$this->FE->date.'_'.$param['entity']['id'].'_'.$id.'_'.$_SESSION['user']['id'];
	}
	break;
	
	default:{
		$id=$this->FE->as_int($param['req_arr']['param_2']);
		
		$table=$this->FE->DB->dbtables['t_'.$type];
		
		$file=$this->FE->config['backup_path'].'/'.$this->FE->config['site'].'/'.$type.'/'.$this->FE->date.'_0_'.$id.'_'.$_SESSION['user']['id'];
	}
	break;
	
}



$el=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `$table` WHERE id='$id'");

if($el['id']) {
	$this->FE->w2f($file,serialize($el));
	$backup_arr=array(
		'created_at'=>$this->FE->date,
		'user'=>$_SESSION['user']['id'],
		'entity'=>$param['entity']['id'],
		'el_id'=>$id,
		'el_type'=>$type,
		);
	$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_backup'],$backup_arr);
} else {
	
}
	
?>