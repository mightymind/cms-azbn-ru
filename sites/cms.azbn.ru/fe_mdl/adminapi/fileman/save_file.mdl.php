<?
// Azbn API - Фреймворк ForEach 2.9

$fp = fopen($param['api_resp']['req']['name'], 'w+');
fwrite($fp, $_POST['main_info']);
fclose($fp);

$param['api_resp']['info']['item_type']='fileman';
$param['api_resp']['info']['item_count']=1;
$param['api_resp']['info']['info_msg']='Файл сохранен';

?>