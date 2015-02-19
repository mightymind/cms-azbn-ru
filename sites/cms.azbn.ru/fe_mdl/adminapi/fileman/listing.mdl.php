<?
// Azbn API - Фреймворк ForEach 2.9

$dir=$param['api_resp']['req']['dir'];
$dir=strlen($dir)>0?$dir:'.';

$param['api_resp']['response']['item_list']=array();

$dirs=array();
$files=array();

$fp=opendir($dir);
while($cv_file=readdir($fp)) {
	if(is_file($dir."/".$cv_file)) {
		$dirs[]=array(
			'name'=>$cv_file,
			'parent'=>$dir,
			'is_dir'=>0,
			'is_file'=>1,
			);
		} elseif ($cv_file!="." && $cv_file!=".." && is_dir($dir."/".$cv_file)) {
			$files[]=array(
				'name'=>$cv_file,
				'parent'=>$dir,
				'is_dir'=>1,
				'is_file'=>0,
				);
			}
	}
closedir($fp);

$param['api_resp']['response']['item_list']=array_merge($files,$dirs);

$param['api_resp']['info']['item_dir']=$dir;
$param['api_resp']['info']['item_type']='fileman';
$param['api_resp']['info']['item_count']=count($param['api_resp']['response']['item_list']);
$param['api_resp']['info']['info_msg']='Содержимое директории '.$dir;

?>