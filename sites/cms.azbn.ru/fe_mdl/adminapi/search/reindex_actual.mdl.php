<?
// Azbn API - Фреймворк ForEach 2.9

if($this->FE->DB->dbQuery("TRUNCATE TABLE `{$this->FE->DB->dbtables['t_searchactual']}`")) {
	
	$title_list=array();
	//$title_arr=array();
	
	$param['future_list']=$this->FE->DB->dbSelect("SELECT * FROM `".$this->FE->DB->dbtables['t_future']."` WHERE (stop>'".$this->FE->date."' OR date>'".$this->FE->date."') AND visible='1' ORDER BY date LIMIT 25");
	while($row=mysql_fetch_array($param['future_list'])) {
		
		$tags=explode(';',mb_strtolower($row['tag'],'UTF-8'));
		if(count($tags)) {
			foreach($tags as $tag) {
				$title_list[trim($tag)]++;
				}
			}
		
		}
	
	$param['news_list']=$this->FE->DB->dbSelect("SELECT * FROM `".$this->FE->DB->dbtables['t_news']."` WHERE visible='1' ORDER BY id DESC LIMIT 25");
	while($row=mysql_fetch_array($param['news_list'])) {
		
		$tags=explode(';',mb_strtolower($row['tag'],'UTF-8'));
		if(count($tags)) {
			foreach($tags as $tag) {
				$title_list[trim($tag)]++;
				}
			}
		
		}
	
	if(count($title_list)) {
		foreach($title_list as $str=>$counter) {
			//999999999
			if(mb_strlen($str,'UTF-8')>2 && ($str<>'')) {
				$searchactual=array('title'=>$str,'rating'=>$this->FE->as_int(999999999-$counter));
				$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_searchactual'],$searchactual);
				}
			}
		}
	
	$param['api_resp']['info']['info_msg']='Обновление поискового индекса произведено';
	
	$log_id=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_log'],array(
		'created_at'=>$this->FE->date,
		'user'=>$_SESSION['user']['id'],
		'el_id'=>0,
		'el_type'=>'searchactual',
		'type'=>'reindex',
		'param'=>serialize(array())
		));
	
	} else {
		$param['api_resp']['info']['info_msg']='Обновление поискового индекса не произведено';
		}
	
?>