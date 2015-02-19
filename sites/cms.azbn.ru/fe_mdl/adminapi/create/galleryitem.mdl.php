<?
// Azbn API - Фреймворк ForEach 2.9

$galleryitem=array(
	'created_at'=>$this->FE->date,
	'gal'=>$param['api_resp']['req']['gal'],
	'seo'=>$param['api_resp']['req']['seo'],
	'user'=>$_SESSION['user']['id'],
	'img'=>$param['api_resp']['req']['img'],
	);

$galleryitem['id']=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_galleryitem'],$galleryitem);

if($galleryitem['id']) {
	
	$param['api_resp']['response']['item_list']=array();
	$param['api_resp']['response']['result']['item_list']=0;
	
	$param['api_resp']['info']['info_msg']='Изображение добавлено в галерею';
	$param['api_resp']['response']['result']['item']=1;
	$param['api_resp']['response']['item']=$galleryitem;
	
	} else {
		
		$param['api_resp']['info']['info_msg']='Изображение не добавлено в галерею';
		$param['api_resp']['response']['result']['item']=0;
		$param['api_resp']['response']['result']['item_list']=0;
		$param['api_resp']['response']['item']=array();
		$param['api_resp']['response']['item_list']=array();
		
		}

?>