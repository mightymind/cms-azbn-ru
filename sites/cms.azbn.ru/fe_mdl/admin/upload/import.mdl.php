<?
// стандартный файл загрузки

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

?>