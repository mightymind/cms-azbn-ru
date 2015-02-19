<?

$type=$this->FE->c_s($param['req_arr']['param_1']);

$_filter=array();
if(is_array($_POST['filter']) && count($_POST['filter'])) {
	foreach($_POST['filter'] as $fid=>$fval) {
		if($this->FE->as_int($fval)) {
			$_filter[]="|$fid|";
			}
		}
	}
$_filter=implode(',',$_filter);

$gal='';
if(is_array($_POST['gal']) && count($_POST['gal'])) {
	$gal=implode(',',$_POST['gal']);
}
//'gal'=>$gal,

$video=explode('?',$_POST['param']['yt_video']);
parse_str($video[1], $video);
$video=$video['v'];
$video_img='http://i1.ytimg.com/vi/'.$video.'/default.jpg';

$_param=array(	'yt_video'=>$video,
				'yt_img'=>$video_img
				);

$date_=strtotime($this->FE->_post('date').' '.$this->FE->_post('time'));
$stop_=strtotime($this->FE->_post('sdate').' '.$this->FE->_post('stime'));
if($stop_<$date_) {
	$stop_=strtotime($this->FE->_post('date').' 23:59:59')+1;
	}

$param['new_el']=array(
	'created_at'=>$this->FE->date,
	'start_at'=>$date_,
	'stop_at'=>$stop_,
	'visible'=>$this->FE->as_int($_POST['visible']),
	'seo'=>$this->FE->as_int($_POST['seo']),
	'rating'=>$this->FE->as_int($_POST['rating']),
	'user'=>$_SESSION['user']['id'],
	'title'=>$this->FE->_post('title'),
	'url'=>$this->FE->_post('url'),
	'img'=>$this->FE->ch($_POST['img']),
	'gal'=>$gal,
	'preview'=>$this->FE->_post('preview'),
	'tag'=>$this->FE->_post('tag'),
	'main_info'=>$this->FE->ch($_POST['main_info']),
	'filter'=>$_filter,
	'param'=>serialize($_param),
	);

$param['new_el_id']=$this->DB->dbInsert($this->DB->dbtables['t_'.$type],$param['new_el']);

$log_id=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_log'],array(
	'created_at'=>$this->FE->date,
	'user'=>$_SESSION['user']['id'],
	'el_id'=>$param['new_el_id'],
	'el_type'=>$type,
	'type'=>'create',
	'param'=>serialize(array())
	));
?>