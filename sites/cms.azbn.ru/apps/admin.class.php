<?
// CMS Azbn.ru Публичная версия

class Admin
{
public $class_name='admin';

	function __construct()
	{
		if(!$_SESSION['user']['id'] || !$_SESSION['user']['right']['is_admin']) {
			Header('Location: /login/');
			}
		}
	
	public function index(&$param)
	{
		$this->FE->go2('/admin/page/index/');
		}
	
	public function page(&$param)
	{
		$tpl=$this->FE->c_s($param['req_arr']['param_1']);
		$this->FE->load(array('path'=>$this->FE->config['app_path'],'class'=>'Adminviewer','var'=>'Viewer'));
		$this->FE->Viewer->startofpage($param);
		$this->FE->Viewer->form('admin/page/'.$tpl,$param);
		$this->FE->Viewer->endofpage($param);
		}
	
	public function edit_file(&$param)
	{
		$param['file']=array(
			'name'=>$this->FE->_get('file'),
			'main_info'=>file_get_contents($this->FE->_get('file')),
			);
		$this->FE->load(array('path'=>$this->FE->config['app_path'],'class'=>'Adminviewer','var'=>'Viewer'));
		$this->FE->Viewer->form('admin/page/edit_file',$param);
		}
	
	public function stop(&$param)
	{
		unset($_SESSION);
		$this->FE->go2('/');
		}
	
	public function upload_img(&$param)
	{
		/*
		передаются параметры размеров картинок w, h
		*/
		
		/*
		$width=$this->FE->c_s($param['req_arr']['param_1']);
		$height=$this->FE->c_s($param['req_arr']['param_2']);
		$crop=$this->FE->c_s($param['req_arr']['param_3']);
		$gray=$this->FE->c_s($param['req_arr']['param_4']);
		*/
		$width=$this->FE->as_int($_GET['w']);
		$height=$this->FE->as_int($_GET['h']);
		$crop=$this->FE->as_int($_GET['crop']);
		$gray=$this->FE->as_int($_GET['gray']);
		$subpath=isset($_GET['path'])?($this->FE->_get('path')):('');
		
		$this->FE->load(array('path'=>$this->FE->config['sys_path'],'class'=>'Upload','var'=>'Upload'));
		//$this->FE->Upload->_init(array('path'=>'upload/'.$this->FE->config['site'].'/'));
		$this->FE->Upload->_init(array('path'=>'upload/'.$this->FE->config['site'].'/'.$subpath.'/'));
		$img_arr=array(
					'field_name'=>'icon_img',
					'new_file'=>$this->FE->date.'_'.$this->FE->hash($this->FE->randstr(12,true)),
					'suff'=>''
					);
		$file=$this->FE->Upload->save($img_arr);
		$this->FE->unload('Upload');
		
		//$img_file='upload/'.$this->FE->config['site'].'/'.$img_arr['new_file'];
		$img_file='upload/'.$this->FE->config['site'].'/'.$subpath.'/'.$img_arr['new_file'];
		
		$this->FE->load(array('path'=>$this->FE->config['sys_path'],'class'=>'Imager','var'=>'Img'));
		if($this->FE->Img->load($img_file)) {
			
			$this->FE->Img->SizeForNewImage($width, $height);
			
			if($crop) {
				
				$this->FE->Img->new_image=imagecreatetruecolor($this->FE->Img->new_width, $this->FE->Img->new_height);
				
				$ratio=$this->FE->Img->width/$this->FE->Img->height;
				$ratio_new=$width/$height;
				
				if($ratio > $ratio_new) {
					
					$w_=round($this->FE->Img->height*$ratio_new);
					$w_semi=round(abs($this->FE->Img->width-$w_)/2);
					imagecopyresampled(
							$this->FE->Img->new_image,
							$this->FE->Img->image,
								0, 0,
								$w_semi, 0,
								$width, $height,
								$w_, $this->FE->Img->height
								);
					
				} elseif($ratio < $ratio_new) {
					
					$h_=round($this->FE->Img->width/$ratio_new);
					$h_semi=round(abs($this->FE->Img->height-$h_)/2);
					imagecopyresampled(
							$this->FE->Img->new_image,
							$this->FE->Img->image,
								0, 0,
								0, $h_semi,
								$width, $height,
								$this->FE->Img->width, $h_
								);
					
				} else {
					
					imagecopyresampled(
							$this->FE->Img->new_image,
							$this->FE->Img->image,
								0, 0,
								0, 0,
								$width, $height,
								$this->FE->Img->width, $this->FE->Img->height
								);
					
				}
			
			} else {
				
				$this->FE->Img->CalcSizeForNewImage($width,$height);
				$this->FE->Img->CreateNewImage();
				
			}
			
			if($gray) {
				imagefilter($this->FE->Img->new_image, IMG_FILTER_GRAYSCALE);
				}
			$this->FE->Img->CreateImageJPG($this->FE->Img->new_image,'./'.$img_file,90);
			
			}
		$this->FE->unload('Img');
		
		$upl_id=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_uplimg'],array(
			'created_at'=>$this->FE->date,
			'user'=>$_SESSION['user']['id'],
			'url'=>'/'.$img_file,
			));
		
		echo '/'.$img_file;
		//$this->FE->go2('/'.$file);
		}
	
	public function upload_file(&$param)
	{
		$subpath=isset($_GET['path'])?('/'.$this->FE->_get('path').'/'):('/');
		
		$this->FE->load(array('path'=>$this->FE->config['sys_path'],'class'=>'Upload','var'=>'Upload'));
		$this->FE->Upload->_init(array('path'=>'upload/'.$this->FE->config['site'].$subpath));
		$img_arr=array(
					'field_name'=>'uploading_file',
					'new_file'=>$this->FE->date.'_'.$this->FE->hash($this->FE->randstr(12,true)),
					'suff'=>'.'.end(explode(".", $_FILES['uploading_file']['name']))
					);
		$file=$this->FE->Upload->save($img_arr);
		$this->FE->unload('Upload');
		
		$img_file='upload/'.$this->FE->config['site'].$subpath.$img_arr['new_file'].$img_arr['suff'];
		
		$upl_id=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_uplfile'],array(
			'created_at'=>$this->FE->date,
			'user'=>$_SESSION['user']['id'],
			'size'=>$_FILES['uploading_file']['size'],
			'title'=>basename($_FILES['uploading_file']['name']),
			'url'=>'/'.$img_file,
			));
		
		//echo '/'.$img_file;
		//echo '/uplfile/item/'.$upl_id.'/';
		//$this->FE->go2('/'.$file);
		
		if($this->FE->as_int($_GET['realurl'])) {
			echo '/'.$img_file;
		} else {
			echo '/uplfile/item/'.$upl_id.'/';
		}
		
		}
	
	public function upload_import(&$param)
	{
		$subpath=isset($_GET['path'])?('/'.$this->FE->_get('path').'/'):('/');
		
		$this->FE->load(array('path'=>$this->FE->config['sys_path'],'class'=>'Upload','var'=>'Upload'));
		$this->FE->Upload->_init(array('path'=>'upload/'.$this->FE->config['site'].$subpath));
		$img_arr=array(
					'field_name'=>'upload',
					'new_file'=>$this->FE->date.'_'.$this->FE->hash($this->FE->randstr(12,true)),
					'suff'=>'.'.end(explode(".", $_FILES['upload']['name']))
					);
		$file=$this->FE->Upload->save($img_arr);
		$this->FE->unload('Upload');
		
		$img_file='upload/'.$this->FE->config['site'].$subpath.$img_arr['new_file'].$img_arr['suff'];
		
		$upl_id=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_uplfile'],array(
			'created_at'=>$this->FE->date,
			'user'=>$_SESSION['user']['id'],
			'url'=>'/'.$img_file,
			));
		
		$funcNum=$this->FE->_get('CKEditorFuncNum');
		//$CKEditor=$_GET['CKEditor'];
		//$langCode=$_GET['langCode'];
		$message='';
		$url='/'.$img_file;
		echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";
		
		}
	
	public function upload_dataurl(&$param)
	{
		$subpath=isset($_POST['path'])?('/'.$this->FE->_post('path').'/'):('/');
		$img_file='upload/'.$this->FE->config['site'].$subpath.$this->FE->date.'_'.$this->FE->hash($this->FE->randstr(12,true));
		
		$pic = explode(',',$_POST['img_to_save']);
		$pic = str_replace(' ','+',$pic[1]);
		$pic = base64_decode($pic);
		$file = fopen($img_file,w);
		fwrite($file,$pic);
		fclose($file);
		
		$this->FE->load(array('path'=>$this->FE->config['sys_path'],'class'=>'Imager','var'=>'Img'));
		if($this->FE->Img->load($img_file)) {
			
			$width=$this->FE->Img->width;
			$height=$this->FE->Img->height;
			
			$this->FE->Img->SizeForNewImage($width, $height);
			
			$this->FE->Img->CalcSizeForNewImage($width,$height);
			$this->FE->Img->CreateNewImage();
			
			$this->FE->Img->CreateImageJPG($this->FE->Img->new_image,'./'.$img_file,95);
			
			}
		$this->FE->unload('Img');
		
		$upl_id=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_uplimg'],array(
			'created_at'=>$this->FE->date,
			'user'=>$_SESSION['user']['id'],
			'url'=>'/'.$img_file,
			));
		
		echo '/'.$img_file;
		}
	
	public function create(&$param)
	{
		$type=$this->FE->c_s($param['req_arr']['param_1']);
		//$id=$this->FE->c_s($param['req_arr']['param_2']);
		$_id=$this->FE->as_int($param['req_arr']['param_2']);
		
		$param['fe_mdl']['create']='admin/create/'.$type;
		$this->FE->mdl('create',$param);
		
		$param['fe_mdl']['ftsearch_reindex']='admin/ftsearch/reindex';
		$this->FE->mdl('ftsearch_reindex',$param);
		
		if($_id) {
			$entity_id_str="$_id/";
		}
		
		$this->FE->go2('/admin/all/'.$type.'/'.$entity_id_str);
		}
	
	
/* ---------- Редактирование объектов в БД ---------- */
	public function update(&$param)
	{
		$type=$this->FE->c_s($param['req_arr']['param_1']);
		$id=$this->FE->as_int($param['req_arr']['param_2']);
		$_id=$this->FE->as_int($param['req_arr']['param_3']);
		$param['new_el_id']=$id;
		
		$param['fe_mdl']['backup']='admin/backup/to_drive';
		$this->FE->mdl('backup',$param);
		
		$param['fe_mdl']['update']='admin/update/'.$type;
		$this->FE->mdl('update',$param);
		
		$param['fe_mdl']['ftsearch_reindex']='admin/ftsearch/reindex';
		$this->FE->mdl('ftsearch_reindex',$param);
		
		if($_id) {
			$entity_id_str="$id/";
		}
		
		$this->FE->go2('/admin/all/'.$type.'/'.$entity_id_str);
		}
/* ---------- Редактирование объектов в БД ---------- */




/* ---------- Удаление объектов из БД ---------- */
	public function delete(&$param)
	{
		$type=$this->FE->c_s($param['req_arr']['param_1']);
		$id=$this->FE->c_s($param['req_arr']['param_2']);
		$_id=$this->FE->as_int($param['req_arr']['param_3']);
		$param['new_el_id']=$id;
		
		if($type=='galleryitem') {
			$gal=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_galleryitem']."` WHERE id='{$id}'");
			$gal=$this->FE->as_int($gal['gal']);
		}
		
		$param['fe_mdl']['backup']='admin/backup/to_drive';
		$this->FE->mdl('backup',$param);
		
		$param['fe_mdl']['delete']='admin/delete/'.$type;
		$this->FE->mdl('delete',$param);
		
		$param['fe_mdl']['ftsearch_delete']='admin/ftsearch/delete';
		$this->FE->mdl('ftsearch_delete',$param);
		
		if($_id) {
			$entity_id_str="$id/";
		}
		
		if($type=='galleryitem') {
			$this->FE->go2('/admin/edit/gallery/'.$gal.'/#table-of-galleryitem-header');
		} else {
			$this->FE->go2('/admin/all/'.$type.'/'.$entity_id_str);
		}
		
		}
/* ---------- Удаление объектов из БД ---------- */



/* ---------- Форма редактирования объектов в БД ---------- */
	public function edit(&$param)
	{
		$type=$this->FE->c_s($param['req_arr']['param_1']);
		$id=$this->FE->c_s($param['req_arr']['param_2']);
		$_id=$this->FE->as_int($param['req_arr']['param_3']);
		
		$param['fe_mdl']['edit']='admin/edit/'.$type;
		$this->FE->mdl('edit',$param);
		
		$this->FE->load(array('path'=>$this->FE->config['app_path'],'class'=>'Adminviewer','var'=>'Viewer'));
		$param['page_title']='Редактирование записи - '.$this->fe_config['enginetitle'];
		$this->FE->Viewer->startofpage($param);
		$this->FE->Viewer->form($param['html_tpl'],$param);
		$this->FE->Viewer->endofpage($param);
		}
	
	public function backup(&$param)
	{
		$type=$this->FE->c_s($param['req_arr']['param_1']);
		$id=$this->FE->c_s($param['req_arr']['param_2']);
		$_id=$this->FE->as_int($param['req_arr']['param_3']);
		
		$param['backup_el']=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_backup']."` WHERE id='$id'");
		
		$param['fe_mdl']['backup']='admin/backup/'.$type;
		$this->FE->mdl('backup',$param);
		
		$this->FE->load(array('path'=>$this->FE->config['app_path'],'class'=>'Adminviewer','var'=>'Viewer'));
		$param['page_title']='Редактирование восстановленной записи - '.$this->fe_config['enginetitle'];
		$this->FE->Viewer->startofpage($param);
		$this->FE->Viewer->form($param['html_tpl'],$param);
		$this->FE->Viewer->endofpage($param);
		
		//$param['edit_el']=unserialize(file_get_contents($this->FE->config['backup_path'].'/'.$this->FE->config['site'].'/'.$param['backup_el']['el_type'].'/'.$param['backup_el']['created_at'].'_'.$param['backup_el']['el_id'].'_'.$param['backup_el']['user']));
		//$param['html_tpl']='admin/edit/'.$param['backup_el']['el_type'];
		}
/* ---------- Форма редактирования объектов в БД ---------- */



/* ---------- Форма создания объектов в БД ---------- */
	public function add(&$param)
	{
		$type=$this->FE->c_s($param['req_arr']['param_1']);
		$id=$this->FE->c_s($param['req_arr']['param_2']);
		$_id=$this->FE->as_int($param['req_arr']['param_3']);
		
		$param['fe_mdl']['add']='admin/add/'.$type;
		$this->FE->mdl('add',$param);
		
		$this->FE->load(array('path'=>$this->FE->config['app_path'],'class'=>'Adminviewer','var'=>'Viewer'));
		$param['page_title']='Создание записи - '.$this->fe_config['enginetitle'];
		$this->FE->Viewer->startofpage($param);
		$this->FE->Viewer->form($param['html_tpl'],$param);
		$this->FE->Viewer->endofpage($param);
		}
/* ---------- Форма создания объектов в БД ---------- */

/* ---------- Все объекты в БД ---------- */
	public function all(&$param)
	{
		$type=$this->FE->c_s($param['req_arr']['param_1']);
		$id=$this->FE->c_s($param['req_arr']['param_2']);
		$_id=$this->FE->as_int($param['req_arr']['param_3']);
		
		$param['fe_mdl']['all']='admin/all/'.$type;
		$this->FE->mdl('all',$param);
		
		$this->FE->load(array('path'=>$this->FE->config['app_path'],'class'=>'Adminviewer','var'=>'Viewer'));
		$param['page_title']='Все записи - '.$this->fe_config['enginetitle'];
		$this->FE->Viewer->startofpage($param);
		$this->FE->Viewer->form($param['html_tpl'],$param);
		$this->FE->Viewer->endofpage($param);
		}
	/* ---------- Все объекты в БД ---------- */

}

?>