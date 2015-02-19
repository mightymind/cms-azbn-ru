<?
// Azbn API - Фреймворк ForEach 2.9

if(mb_strlen($param['api_resp']['req']['query'],'UTF-8')>2) {
	$param['item_list']=$this->FE->DB->dbSelect("SELECT id,title,img FROM `".$this->FE->DB->dbtables['t_'.$param['api_resp']['req']['item_type']]."` WHERE (title LIKE '%".$param['api_resp']['req']['query']."%' OR preview LIKE '%".$param['api_resp']['req']['query']."%') ORDER BY title");
	$param['api_resp']['info']['item_type']=$param['api_resp']['req']['item_type'];
	$param['api_resp']['info']['item_count']=mysql_num_rows($param['item_list']);
	$param['api_resp']['info']['info_msg']='Найдено по запросу <strong>'.$param['api_resp']['req']['query'].'</strong>: '.$param['api_resp']['info']['item_count'];
	
	while($row=mysql_fetch_array($param['item_list'])) {
		$param['api_resp']['response']['item_list'][]=array(
			'id'=>$row['id'],
			'title'=>$row['title'],
			'img'=>$row['img']
			);
		}
	} else {
		$param['api_resp']['response']['item_list']=array();
		$param['api_resp']['info']['item_type']=$param['api_resp']['req']['item_type'];
		$param['api_resp']['info']['item_count']=0;
		$param['api_resp']['info']['info_msg']='Слишком короткий запрос для поиска';
		}
		
?>