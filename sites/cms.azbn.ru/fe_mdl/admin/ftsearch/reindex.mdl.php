<?
$type=$this->FE->c_s($param['req_arr']['param_1']);
//$_id=$this->FE->as_int($param['req_arr']['param_3']);

//$table=$this->FE->config['mysql_prefix'].'_'.$param['entity']['url'];

switch($type) {
	
	case 'page':
	case 'post':
	case 'news':
	case 'calendar':
	case 'geopoint': {
		$full_text=$this->FE->_post('title').' '.$this->FE->_post('preview').' '.$this->FE->_post('tag').' '.$this->FE->c_s(strip_tags($_POST['main_info']));
	}
	break;
	
	case 'pagecat':
	case 'postcat':
	case 'newscat':
	//case 'calendar':
	case 'geopointcat': {
		$full_text=$this->FE->_post('title').' '.$this->FE->_post('preview');
	}
	break;
	
	case 'entitycat':
	case 'entityitem': {
		$full_text=$this->FE->_post('title').' '.$this->FE->_post('preview').' '.$this->FE->_post('tag').' '.$this->FE->c_s(strip_tags($_POST['main_info']));
		
		$entity_id=$this->FE->as_int($param['req_arr']['param_2']);
		$param['entity']=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_entity']."` WHERE id='$entity_id'");
		$param['entity']['id']=$this->FE->as_int($param['entity']['id']);
		$stop_reindex=!$this->FE->as_int($param['entity']['ftsearch']);
		//$param['entity']['param']=unserialize($param['entity']['param']);
	}
	break;
	
	case 'feedback': {
		$full_text=$this->FE->c_s(strip_tags($_POST['main_info']));
	}
	break;
	
	case 'faq': {
		$full_text=$this->FE->c_s(strip_tags($_POST['main_info'])).' '.$this->FE->c_s(strip_tags($_POST['resp']));
	}
	break;
	
	case 'galleryitem': {
		$full_text=$this->FE->_post('title').' '.$this->FE->_post('tag');
	}
	break;
	
	case 'gallery': {
		$full_text=$this->FE->_post('title').' '.$this->FE->_post('preview');
	}
	break;
	
	default:{
		$full_text='';
		$stop_reindex=true;
	}
	break;
}

if(!$stop_reindex) {

	$full_text=mb_strtolower(strtr($full_text,array(
		'.'=>' ',
		','=>' ',
		'?'=>' ',
		'!'=>' ',
		';'=>' ',
		':'=>' ',
		'"'=>' ',
		"'"=>' ',
		"\t"=>' ',
		"\r"=>' ',
		"\n"=>' ',
		'='=>' ',
		'+'=>' ',
		'-'=>' ',
		'*'=>' ',
		'|'=>' ',
		'/'=>' ',
		'\\'=>' ',
		'('=>' ',
		')'=>' ',
		'^'=>' ',
		'$'=>' ',
		'#'=>' ',
		'`'=>' ',
		'@'=>' ',
		'{'=>' ',
		'}'=>' ',
		)), $this->FE->config['charset']);
	$full_text=strtr($full_text,array(
		'    '=>' ',
		'   '=>' ',
		'  '=>' ',
		));
	$full_text_arr=explode(' ',$full_text);
	$full_text_arr=array_unique($full_text_arr, SORT_STRING);
	if(count($full_text_arr)) {
		foreach($full_text_arr as $w_index=>$word) {
			if(mb_strlen($word,$this->FE->config['charset'])>2) {
				
			} else {
				unset($full_text_arr[$w_index]);
			}
		}
	}
	$full_text=mb_strtoupper(implode(' ',$full_text_arr),$this->FE->config['charset']);
	
	$full_text_arr=explode(' ',$full_text);
	
	//$morphy_path=$this->FE->config['phpmorphy_path'];
		require_once($this->FE->config['phpmorphy_path'].'src/common.php');
		$morphy = new phpMorphy($this->FE->config['phpmorphy_path'].'dicts/'.$this->FE->config['charset'].'/', 'ru_RU', array(
			// PHPMORPHY_STORAGE_FILE - использовать файл
			// PHPMORPHY_STORAGE_SHM - загружать словать в общую память(нужно расширение shmop)
			// PHPMORPHY_STORAGE_MEM - загружать словать в общую память при каждой инициализации phpmorphy
			'storage' => PHPMORPHY_STORAGE_FILE,
			'predict_by_suffix' => true,
			'predict_by_db' => true,
			'graminfo_as_text' => true,
			));
	$forms=array();
	foreach($morphy->getBaseForm($full_text_arr) as $w=>$form_arr) {
		$forms[]=$w;
		if(count($form_arr)) {
			foreach($form_arr as $f) {
				$forms[]=$f;
			}
		} else {
			
		}
	}
	unset($full_text_arr);
	unset($morphy);
	$forms=array_unique($forms, SORT_STRING);
	$full_text=mb_strtolower(implode(' ',$forms),$this->FE->config['charset']);
	
	if($param['entity']['id']) {
		$el_id=$this->FE->as_int($param['req_arr']['param_3']);
		$is_entity=$param['entity']['id'];
	} else {
		$el_id=$this->FE->as_int($param['req_arr']['param_2']);
		$is_entity=0;
	}

	$el=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_ftsearch']."` WHERE el_id='{$el_id}' AND entity='$is_entity' AND el_type='$type'");
	if($el_id && $el['id']) {
		$reindex_arr=array(
			//'created_at'=>$this->FE->date,
			'updated_at'=>$this->FE->date,
			'visible'=>$this->FE->as_int($_POST['visible']),
			'rating'=>(isset($_POST['rating'])?$this->FE->as_int($_POST['rating']):999999999),
			//'el_id'=>$param['new_el_id'],
			//'el_type'=>$type,
			'main_info'=>$full_text,
			);
		$this->FE->DB->dbUpdateArr($this->FE->DB->dbtables['t_ftsearch'],$reindex_arr,"WHERE el_id='{$param['new_el_id']}' AND entity='$is_entity' AND el_type='$type'");
	} else {
		$reindex_arr=array(
			'created_at'=>$this->FE->date,
			'updated_at'=>$this->FE->date,
			'visible'=>$this->FE->as_int($_POST['visible']),
			'entity'=>$is_entity,
			'rating'=>(isset($_POST['rating'])?$this->FE->as_int($_POST['rating']):999999999),
			'el_id'=>$param['new_el_id'],
			'el_type'=>$type,
			'main_info'=>$full_text,
			);
		$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_ftsearch'],$reindex_arr);
	}
	/*
	$log_id=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_log'],array(
		'created_at'=>$this->FE->date,
		'user'=>$_SESSION['user']['id'],
		'el_id'=>$param['new_el_id'],
		'el_type'=>$type,
		'type'=>'fulltext_reindex',
		'param'=>serialize(array()),
		));
	*/
}
	
?>