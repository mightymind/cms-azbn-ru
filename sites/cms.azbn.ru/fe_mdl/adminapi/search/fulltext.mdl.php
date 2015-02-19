<?
// Azbn API - Фреймворк ForEach 2.9

if(mb_strlen($param['api_resp']['req']['query'],'UTF-8')>2) {
	
	$param['api_resp']['req']['query']=mb_strtolower($param['api_resp']['req']['query'], $this->FE->config['charset']);
	
	$ftsearch_list=$this->FE->DB->dbSelect("SELECT
				entity,
				el_type,
				el_id,
				updated_at
			FROM `".$this->FE->DB->dbtables['t_ftsearch']."`
			WHERE
				(
				MATCH (main_info) AGAINST ('{$param['api_resp']['req']['query']}' IN BOOLEAN MODE) > 0
				OR
				main_info LIKE '%{$param['api_resp']['req']['query']}%'
				)
			ORDER BY
				rating,
				updated_at DESC");
	
	$param['api_resp']['response']['item_list']=array();
	while($row=mysql_fetch_array($ftsearch_list)) {
		if($row['entity']) {
			$table=$this->FE->config['mysql_prefix'].'_'.$row['el_type'];
		} else {
			$table=$this->FE->DB->dbtables['t_'.$row['el_type']];
		}
		$item=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `$table` WHERE id='{$row['el_id']}'");
		if($item['id']) {
			
			$param['api_resp']['response']['item_list'][]=array(
				'id'=>$this->FE->as_int($item['id']),
				'entity'=>$this->FE->as_int($row['entity']),
				'type'=>$row['el_type'],
				'title'=>$item['title'],
				'img'=>$item['img'],
				);
			
		}
	}
	
	$param['api_resp']['info']['item_count']=count($param['api_resp']['response']['item_list']);
	$param['api_resp']['info']['info_msg']='Найдено по запросу <strong>'.$param['api_resp']['req']['query'].'</strong>: '.$param['api_resp']['info']['item_count'];
	
	} else {
		$param['api_resp']['response']['item_list']=array();
		$param['api_resp']['info']['item_count']=0;
		$param['api_resp']['info']['info_msg']='Слишком короткий запрос для поиска';
		}
		
?>