<?
// стандартный файл загрузки

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
		
		$param['new_el'] = array(
			'created_at'=>$this->FE->date,
			'user'=>$_SESSION['user']['id'],
			'size'=>$_FILES['uploading_file']['size'],
			'title'=>basename($_FILES['uploading_file']['name']),
			'url'=>'/'.$img_file,
			);
		
		$param['new_el_id']=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_uplfile'],$param['new_el']);
		
		//echo '/'.$img_file;
		//echo '/uplfile/item/'.$param['new_el_id'].'/';
		//$this->FE->go2('/'.$file);
		
		if($this->FE->as_int($_GET['realurl'])) {
			echo '/'.$img_file;
		} else {
			echo '/uplfile/item/'.$param['new_el_id'].'/';
		}
?>