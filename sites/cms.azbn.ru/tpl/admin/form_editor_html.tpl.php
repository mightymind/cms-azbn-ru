<?

//$type=$this->FE->c_s($param['req_arr']['param_1']);

switch($_SESSION['user']['param']['default_editor']) {
	
	case 'cmsazbn':{
		//$param['upload_path']=$type.'/main_info';
		}
		break;
	
	case 'textarea':{
		
		}
		break;
	
	case 'ckeditor':{
		$param['run_editor']['element']['upload_path']='import/ckeditor';
		}
		break;
	
	case 'cleditor':{
		$param['run_editor']['element']['upload_path']='import/cleditor';
		}
		break;
	
	default:{
		$_SESSION['user']['param']['default_editor']='ckeditor';
		$param['run_editor']['element']['upload_path']='import/other';
		}
		break;
	
	}

$this->FE->Viewer->form('admin/editor/'.$_SESSION['user']['param']['default_editor'],$param);

?>