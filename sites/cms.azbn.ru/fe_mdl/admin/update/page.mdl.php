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

$param['new_el']=array(
	'cat'=>$this->FE->as_int($_POST['parent']),
	'visible'=>$this->FE->as_int($_POST['visible']),
	'seo'=>$this->FE->as_int($_POST['seo']),
	'rating'=>$this->FE->as_int($_POST['rating']),
	'title'=>$this->FE->_post('title'),
	'url'=>$this->FE->_post('url'),
	'img'=>$this->FE->ch($_POST['img']),
	'gal'=>$gal,
	'preview'=>$this->FE->_post('preview'),
	'tag'=>$this->FE->_post('tag'),
	'main_info'=>$this->FE->ch($_POST['main_info']),
	'filter'=>$_filter,
	'param'=>serialize($_param)
	);

if($_SESSION['user']['right']['change_page_superuser'] && isset($_POST['user'])) {
	$param['new_el']['user']=$this->FE->as_int($_POST['user']);
	}

$this->DB->dbUpdateArr($this->DB->dbtables['t_'.$type],$param['new_el'],"WHERE id='{$param['new_el_id']}'");

$log_id=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_log'],array(
	'created_at'=>$this->FE->date,
	'user'=>$_SESSION['user']['id'],
	'el_id'=>$param['new_el_id'],
	'el_type'=>$type,
	'type'=>'update',
	'param'=>serialize(array())
	));
	
?>