<?
// стандартный файл загрузки

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
		
		$param['new_el'] = array(
			'created_at'=>$this->FE->date,
			'user'=>$_SESSION['user']['id'],
			'url'=>'/'.$img_file,
			);
		
		$param['new_el_id']=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_uplimg'], $param['new_el']);
		
		echo '/'.$img_file;
?>