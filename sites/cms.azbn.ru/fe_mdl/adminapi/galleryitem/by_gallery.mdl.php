<?
// Azbn API - Фреймворк ForEach 2.9

$param['item_list']=$this->FE->DB->dbSelect("SELECT id,title,img FROM `".$this->FE->DB->dbtables['t_galleryitem']."` WHERE (gal='".$param['api_resp']['req']['gal']."') ORDER BY created_at DESC");

while($row=mysql_fetch_array($param['item_list'])) {
	$param['api_resp']['response']['item_list'][]=array(
		'id'=>$row['id'],
		'title'=>$row['title'],
		'img'=>$row['img'],
		);
	}

$count=count($param['api_resp']['response']['item_list']);
if($count) {
	
	$param['api_resp']['info']['info_msg']='Картинок в галерее: '.$count;
	
} else {
	
	$param['api_resp']['info']['info_msg']='Картинок в галерее нет ';
	
}

?>