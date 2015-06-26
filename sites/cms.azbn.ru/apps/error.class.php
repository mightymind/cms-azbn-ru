<?
// CMS Azbn.ru Публичная версия

class Error
{
public $class_name='error';

	function __construct()
	{
		
	}
		
	public function index(&$param)
	{
		$this->FE->go2('/');
	}
	
	public function by_url(&$param)
	{
		$param['page_html']['seo']=$this->FE->CMS->getSEO(4);
		
		$this->FE->load(array('path'=>$this->FE->config['app_path'],'class'=>'Viewer','var'=>'Viewer'));
		$this->FE->Viewer->startofpage($param);
		$this->FE->Viewer->form('error/by_url',$param);
		$this->FE->Viewer->endofpage($param);
	}
	
}

?>