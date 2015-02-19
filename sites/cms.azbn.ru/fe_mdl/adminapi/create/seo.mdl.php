<?
// Azbn API - Фреймворк ForEach 2.9

$seo=array(
	'title'=>$param['api_resp']['req']['title'],
	'desc'=>$param['api_resp']['req']['desc'],
	'kw'=>$param['api_resp']['req']['kw'],
	);

$seo['id']=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_seo'],$seo);

if($seo['id']) {
	
	$param['api_resp']['response']['item_list']=array();
	$seo_list=$this->FE->DB->dbSelect("SELECT * FROM `".$this->FE->DB->dbtables['t_seo']."` ORDER BY title");
	while($row=mysql_fetch_array($seo_list)) {
		$param['api_resp']['response']['item_list'][]=array(
			'id'=>$this->FE->as_int($row['id']),
			'title'=>$row['title'],
			);
		}
	$param['api_resp']['response']['result']['item_list']=count($param['api_resp']['response']['item_list']);
	
	$param['api_resp']['info']['info_msg']='Настройка добавлена';
	$param['api_resp']['response']['result']['item']=1;
	$param['api_resp']['response']['item']=$seo;
	
	} else {
		
		$param['api_resp']['info']['info_msg']='Настройка не добавлена';
		$param['api_resp']['response']['result']['item']=0;
		$param['api_resp']['response']['result']['item_list']=0;
		$param['api_resp']['response']['item']=array();
		$param['api_resp']['response']['item_list']=array();
		
		}

?>