<?
$type=$this->FE->c_s($param['req_arr']['param_1']);
$entity_id=$this->FE->c_s($param['req_arr']['param_2']);

$param['entity']=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_entity']."` WHERE id='$entity_id'");
$param['entity']['param']=unserialize($param['entity']['param']);

$table=$this->FE->config['mysql_prefix'].'_'.$param['entity']['url'];

$_filter=array();
if($param['entity']['param']['field']['item']['filter']) {
if(is_array($_POST['filter']) && count($_POST['filter'])) {
	foreach($_POST['filter'] as $fid=>$fval) {
		if($this->FE->as_int($fval)) {
			$_filter[]="|$fid|";
			}
		}
	}
$_filter=implode(',',$_filter);
}

$_param=array(	
				);

if($param['entity']['param']['field']['item']['yt_video']) {
$video=explode('?',$_POST['param']['yt_video']);
parse_str($video[1], $video);
$video=$video['v'];
$video_img='http://i1.ytimg.com/vi/'.$video.'/default.jpg';

$_param['yt_video']=$video;
$_param['yt_img']=$video_img;

}

$param['new_el']=array(
	'created_at'=>$this->FE->date,
	'cat'=>$this->FE->as_int($_POST['parent']),
	'visible'=>$this->FE->as_int($_POST['visible']),
	'seo'=>$this->FE->as_int($_POST['seo']),
	//'rating'=>$this->FE->as_int($_POST['rating']),
	'user'=>$_SESSION['user']['id'],
	'title'=>$this->FE->_post('title'),
	'url'=>$this->FE->_post('url'),
	//'img'=>$this->FE->ch($_POST['img']),
	//'preview'=>$this->FE->_post('preview'),
	//'tag'=>$this->FE->_post('tag'),
	//'main_info'=>$this->FE->ch($_POST['main_info']),
	//'filter'=>$_filter,
	'param'=>serialize($_param)
	);

if($param['entity']['param']['field']['item']['rating']) {
	$param['new_el']['rating']=$this->FE->as_int($_POST['rating']);
}
if($param['entity']['param']['field']['item']['uid']) {
	$param['new_el']['uid']=$this->FE->_post('uid');
}
if($param['entity']['param']['field']['item']['oldcost']) {
	$param['new_el']['oldcost']=$this->FE->as_int($_POST['oldcost']);
}
if($param['entity']['param']['field']['item']['cost']) {
	$param['new_el']['cost']=$this->FE->as_int($_POST['cost']);
}
if($param['entity']['param']['field']['item']['count']) {
	$param['new_el']['count']=$this->FE->as_int($_POST['count']);
}
if($param['entity']['param']['field']['item']['view_as']) {
	$param['new_el']['view_as']=$this->FE->_post('view_as');
}
if($param['entity']['param']['field']['item']['img']) {
	$param['new_el']['img']=$this->FE->ch($_POST['img']);
}
if($param['entity']['param']['field']['item']['preview']) {
	$param['new_el']['preview']=$this->FE->_post('preview');
}
if($param['entity']['param']['field']['item']['tag']) {
	$param['new_el']['tag']=$this->FE->_post('tag');
}

if($param['entity']['param']['field']['item']['gal']) {
	if(is_array($_POST['gal']) && count($_POST['gal'])) {
		$param['new_el']['gal']=implode(',',$_POST['gal']);
	}
	//'gal'=>$gal,
}

if($param['entity']['param']['field']['item']['main_info']) {
	$param['new_el']['main_info']=$this->FE->ch($_POST['main_info']);
}
if($param['entity']['param']['field']['item']['filter']) {
	$param['new_el']['filter']=$_filter;
}

if($param['entity']['param']['field']['item']['coord']) {
	$param['new_el']['lat']=$this->FE->c_s($_POST['lat']);
	$param['new_el']['lng']=$this->FE->c_s($_POST['lng']);
}

if($param['entity']['param']['field']['item']['start_at']) {
	$param['new_el']['start_at']=strtotime($this->FE->_post('date').' '.$this->FE->_post('time'));
}
if($param['entity']['param']['field']['item']['stop_at']) {
	$param['new_el']['stop_at']=strtotime($this->FE->_post('sdate').' '.$this->FE->_post('stime'));
}
if(intval($param['new_el']['stop_at']) < intval($param['new_el']['start_at']) && $param['entity']['param']['field']['item']['stop_at']) {
	$param['new_el']['stop_at']=strtotime($this->FE->_post('date').' 23:59:59')+1;
}
if($param['entity']['param']['field']['item']['profile']) {
	$param['new_el']['profile']=$this->FE->as_int($_POST['profile']);
}

//echo $table."\n";
//var_dump($param['new_el']);die();
//echo count($param['new_el']);die();

$param['new_el_id']=$this->FE->DB->dbInsert($table,$param['new_el']);

$log_id=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_log'],array(
	'created_at'=>$this->FE->date,
	'user'=>$_SESSION['user']['id'],
	'el_id'=>$param['new_el_id'],
	'el_type'=>$type.'.'.$entity_id,
	'type'=>'create',
	'param'=>serialize(array())
	));
?>