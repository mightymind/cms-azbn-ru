<?
// CMS Azbn.ru Публичная версия

class Profile
{
public $class_name='profile';

	function __construct()
	{

		}
	
	public function loadPluginMng($tag='')
	{
		if(!isset($this->FE->PluginMng) || $this->FE->PluginMng==null) {
			$this->FE->load(array('path'=>$this->FE->config['app_path'],'class'=>'Pluginmng','var'=>'PluginMng'));
		}
		if($tag=='') {
			$this->FE->PluginMng->loadPlugins($this->class_name, false);
		} else {
			$this->FE->PluginMng->loadPlugins($tag, false);
		}
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
		
		$param['item_id']=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_'.$param['req_arr']['cont']]."` WHERE ($uid_str='$uid' AND status='1')");
		
		//$param['page_html']['seo']=$this->FE->CMS->getSEO($param['item_id']['seo']);
		
		$this->FE->load(array('path'=>$this->FE->config['app_path'],'class'=>'Viewer','var'=>'Viewer'));
		$this->FE->Viewer->startofpage($param);
		if($param['item_id']['id']) {
			$param['item_id']['param']=unserialize($param['item_id']['param']);
			$this->FE->Viewer->form($param['req_arr']['cont'].'/item',$param);
			} else {
				$this->FE->Viewer->form('no',$param);
				}
		$this->FE->Viewer->endofpage($param);
		}
	
	public function registration(&$param)
	{
		$param['page_title']='Регистрация - '.$this->fe_config['enginetitle'];
		$this->FE->load(array('path'=>$this->FE->config['app_path'],'class'=>'Viewer','var'=>'Viewer'));
		$this->FE->Viewer->startofpage($param);
		$this->FE->Viewer->form('profile/registration',$param);
		$this->FE->Viewer->endofpage($param);
		}
	
	public function index(&$param)
	{
		$param['page_title']='Вход на сайт - '.$this->fe_config['enginetitle'];
		$this->FE->load(array('path'=>$this->FE->config['app_path'],'class'=>'Viewer','var'=>'Viewer'));
		$this->FE->Viewer->startofpage($param);
		$this->FE->Viewer->form('profile/index',$param);
		$this->FE->Viewer->endofpage($param);
		}
	
	public function start($param)
	{
		$this->loadPluginMng();
		
		$login=$this->FE->_post('login');
		$pass=$this->FE->hash($this->FE->_post('pass'),$login,'profile');
		$user_id=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_profile']."` WHERE status=1 AND login='$login' AND pass='$pass'");
		if($user_id['id']) {
			
			$log_id=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_log'],array(
				'created_at'=>$this->FE->date,
				'user'=>$user_id['id'],
				'el_id'=>$user_id['id'],
				'el_type'=>'profile',
				'type'=>'login',
				'param'=>serialize(array())
				));
			
			$_SESSION['profile']=$user_id;
			$_SESSION['profile']['param']=unserialize($user_id['param']);
			$_SESSION['profile']['right']=explode(',',$user_id['right']);
			if(count($_SESSION['profile']['right'])) {
				$right=$_SESSION['profile']['right'];
				unset($_SESSION['profile']['right']);
				$_SESSION['profile']['right']=array();
				foreach($right as $right_id) {
					$_SESSION['profile']['right'][$right_id]=1;
					}
				}
			
			$this->FE->PluginMng->event('profile:start:after_ok', $param);
			
			$this->FE->go2('/profile/item/'.$_SESSION['profile']['id']);
			
			} else {
				
				$this->FE->PluginMng->event('profile:start:after_notok', $param);
				$_SESSION['tmp']['error']='Вы не смогли войти под логином '.$login.'. Проверьте введенные данные.';
				$this->FE->go2('/profile/');
				
				}
		}
	
	public function create(&$param)
	{
		$this->loadPluginMng();
		
		$param['new_el']=array(
			'login'=>$this->FE->_post('login'),
			'view_as'=>$this->FE->_post('view_as'),
			//'img'=>$this->ch($_POST['img']),
			//'right'=>$right,
			'status'=>1,
			'rating'=>999999999,
			'cash'=>1,
			'pass'=>$this->FE->hash($this->FE->_post('pass'),$this->FE->_post('login'),'profile'),
			'param'=>serialize(array(
				'url'=>$this->FE->ch($_POST['url']),
				'vk'=>array(
					'url'=>$this->FE->ch($_POST['vk_url']),
					),
				'twitter'=>array(
					'url'=>$this->FE->ch($_POST['twitter_url']),
					),
				'email'=>$this->FE->_post('email'),
				'adr'=>$this->FE->_post('adr'),
				'phone'=>$this->FE->_post('phone'),
				'timezone'=>$this->FE->_post('timezone'),
				)),
			);

		$profile_id=$this->FE->DB->dbInsertIgnore($this->FE->DB->dbtables['t_profile'],$param['new_el']);
		
		if($profile_id) {
			
			$this->FE->PluginMng->event('profile:create:after_ok', $param);
			$this->FE->go2('/profile/view/'.$profile_id);
			
			}
		
		}
	
	public function off(&$param)
	{
		$this->loadPluginMng();
		$this->FE->PluginMng->event('profile:off:before_unset', $param);
		
		$_SESSION=array();
		unset($_SESSION);
		$this->FE->go2('/');
		}
	
}

?>