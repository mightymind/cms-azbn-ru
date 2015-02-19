<?
// Azbn API - Фреймворк ForEach 2.9

list($type_entity,$id,$field)=explode(':',$param['api_resp']['req']['uid']);
list($type,$entity_id)=explode('.',$type_entity);
$value=$this->FE->ch($_POST['value']);
$entity_id=$this->FE->as_int($entity_id);

switch($type) {
	
	case 'entityitem':{
		$entity=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_entity']."` WHERE id='$entity_id'");
		$table=$this->FE->config['mysql_prefix'].'_'.$entity['url'];
	}
	break;
	
	case 'entitycat':{
		$entity=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_entity']."` WHERE id='$entity_id'");
		$table=$this->FE->config['mysql_prefix'].'_'.$entity['url'].'cat';
	}
	break;
	
	default:{
		$table=$this->FE->DB->dbtables['t_'.$type];
	}
	break;
	
}

$item=array();
$item[$field]=$value;

$this->FE->DB->dbUpdateArr($table,$item,"WHERE id='$id'");

$item['id']=$id;
	
$param['api_resp']['response']['item_list']=array();
$param['api_resp']['response']['result']['item_list']=0;

$param['api_resp']['info']['info_msg']='Значение обновлено';
$param['api_resp']['response']['result']['item']=1;
$param['api_resp']['response']['item']=$item;

?>