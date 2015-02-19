<?
// Azbn API - Фреймворк ForEach 2.9

//$param['api_resp']['req']['path'];
//$param['api_resp']['req']['url'];
$subpath=isset($_POST['path'])?($param['api_resp']['req']['path']):('.');
$path='upload/'.$this->FE->config['site'].'/'.$subpath.'/';
$name=$this->FE->date.'_'.$this->FE->hash($this->FE->randstr(12,true));

if(copy($param['api_resp']['req']['url'],$path.$name)) {
	$upl_id=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_uplimg'],array(
			'created_at'=>$this->FE->date,
			'user'=>$_SESSION['user']['id'],
			'url'=>'/'.$path.$name,
			));
	
	$param['api_resp']['info']['info_msg']='Изображение скопировано.';
	$param['api_resp']['response']['result']['item']=1;
	$param['api_resp']['response']['item']=array(
		'id'=>$upl_id,
		'dest'=>'/'.$path.$name,
		'source'=>$param['api_resp']['req']['path'],
		);
	} else {
		$param['api_resp']['info']['info_msg']='Изображение не скопировано.';
		$param['api_resp']['response']['result']['item']=0;
		$param['api_resp']['response']['item']=array(
			'source'=>$param['api_resp']['req']['path'],
			);
		}

?>