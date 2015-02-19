<?
// Azbn API - Фреймворк ForEach 2.9

$param['api_resp']['info']['info_msg']='URL сформирован';
$param['api_resp']['response']['result']['item']=1;
$param['api_resp']['response']['item']=array(
	'id'=>1,
	'title'=>$param['api_resp']['req']['title'],
	'url'=>$this->FE->ru2en($param['api_resp']['req']['title']),
	);

?>