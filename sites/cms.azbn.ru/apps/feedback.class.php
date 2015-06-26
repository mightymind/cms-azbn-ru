<?
// CMS Azbn.ru Публичная версия

class Feedback
{
public $class_name='feedback';

	function __construct()
	{

		}
		
	public function index(&$param)
	{
		$this->FE->go2('/'.$param['req_arr']['cont'].'/all/');
		}
	
	public function all(&$param)
	{
		$_SESSION['tmp'][$param['req_arr']['cont'].'_session_control']=$this->FE->randstr(16);
		
		$param['item_list']=$this->FE->DB->dbSelect("SELECT * FROM `".$this->FE->DB->dbtables['t_'.$param['req_arr']['cont']]."` WHERE visible='1' ORDER BY created_at DESC");
		
		$param['page_html']['seo']=$this->FE->CMS->getSEO(2);
		$this->FE->PluginMng->event('cms:all:after_select', $param);
		
		$this->FE->load(array('path'=>$this->FE->config['app_path'],'class'=>'Viewer','var'=>'Viewer'));
		$this->FE->Viewer->startofpage($param);
		$this->FE->Viewer->form($param['req_arr']['cont'].'/all',$param);
		$this->FE->Viewer->endofpage($param);
		}
	
	public function create(&$param)
	{
		$strchange=strcmp($this->FE->_post($param['req_arr']['cont'].'_session_control'),$_SESSION['tmp'][$param['req_arr']['cont'].'_session_control']);
		if($strchange==0) {
			$item=array(
				'created_at'=>$this->FE->date,
				'profile'=>isset($_SESSION['profile']['id'])?$_SESSION['profile']['id']:0,
				'visible'=>0,
				'view_as'=>$this->FE->_post('view_as'),
				'phone'=>$this->FE->_post('phone'),
				'email'=>$this->FE->_post('email'),
				'main_info'=>$this->FE->_post('main_info'),
				);
			$item['id']=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_'.$param['req_arr']['cont']],$item);
			
			if($item['id']) {
				
				$this->FE->PluginMng->event('feedback:create:after', $item);
				
				$this->FE->go2('/'.$param['req_arr']['cont'].'/created/');
			} else {
				$this->FE->go2('/'.$param['req_arr']['cont'].'/not_created/');
			}
			unset($_SESSION['tmp'][$param['req_arr']['cont'].'_session_control']);
		} else {
			echo $strchange;
		}
	}
	
	public function created(&$param)
	{
		$param['page_html']['seo']=$this->FE->CMS->getSEO(2);
		
		$this->FE->load(array('path'=>$this->FE->config['app_path'],'class'=>'Viewer','var'=>'Viewer'));
		$this->FE->Viewer->startofpage($param);
		$this->FE->Viewer->form($param['req_arr']['cont'].'/created',$param);
		$this->FE->Viewer->endofpage($param);
	}
	
	public function not_created(&$param)
	{
		$param['page_html']['seo']=$this->FE->CMS->getSEO(2);
		
		$this->FE->load(array('path'=>$this->FE->config['app_path'],'class'=>'Viewer','var'=>'Viewer'));
		$this->FE->Viewer->startofpage($param);
		$this->FE->Viewer->form($param['req_arr']['cont'].'/not_created',$param);
		$this->FE->Viewer->endofpage($param);
	}
	
}

?>