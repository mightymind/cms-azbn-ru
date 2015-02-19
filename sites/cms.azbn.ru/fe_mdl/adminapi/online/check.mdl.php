<?
// Azbn API - Фреймворк ForEach 2.9

$param['api_resp']['info']['info_msg']='Соединение установлено.';
$param['api_resp']['response']['result']['item']=1;
$param['api_resp']['response']['item']=array(
	'status'=>1,
	'check'=>$param['api_resp']['req']['check'],
	'md5'=>md5($param['api_resp']['req']['check'])
	);

?>