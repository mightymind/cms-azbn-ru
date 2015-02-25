<?
// стандартный файл загрузки

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
?>