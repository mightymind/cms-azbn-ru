<?
// CMS Azbn.ru Публичная версия

class Calendar
{
public $class_name='calendar';

	function __construct()
	{

		}
	
	public function index(&$param)
	{
		$this->FE->go2('/'.$param['req_arr']['cont'].'/all/');
		}
	
	public function all(&$param)
	{
		/*
		$param['item_list']=$this->FE->DB->dbSelect("SELECT * FROM `".$this->FE->DB->dbtables['t_'.$param['req_arr']['cont']]."` WHERE visible='1' ORDER BY title");
		$param['page_html']['seo']=$this->FE->CMS->getSEO(2);
		
		$this->FE->load(array('path'=>$this->FE->config['app_path'],'class'=>'Viewer','var'=>'Viewer'));
		$this->FE->Viewer->startofpage($param);
		$this->FE->Viewer->form($param['req_arr']['cont'].'/all',$param);
		$this->FE->Viewer->endofpage($param);
		*/
		}
	
	public function item(&$param)
	{
		if($this->FE->is_num($param['req_arr']['param_1'])) {
			$uid=$this->FE->as_int($param['req_arr']['param_1']);
			$uid_str='id';
		} else {
			$uid=$this->FE->c_s($param['req_arr']['param_1']);
			$uid_str='url';
		}
		
		$param['item_id']=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_'.$param['req_arr']['cont']]."` WHERE ($uid_str='$uid' AND visible='1')");
		
		//$param['page_html']['seo']=$this->FE->CMS->getSEO($param['item_id']['seo']);
		
		$this->FE->load(array('path'=>$this->FE->config['app_path'],'class'=>'Viewer','var'=>'Viewer'));
		$this->FE->Viewer->startofpage($param);
		if($param['item_id']['id']) {
			$this->FE->Viewer->form($param['req_arr']['cont'].'/item',$param);
			} else {
				$this->FE->Viewer->form('no',$param);
				}
		$this->FE->Viewer->endofpage($param);
		}
	
}

?>