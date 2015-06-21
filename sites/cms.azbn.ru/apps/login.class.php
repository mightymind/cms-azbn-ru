<?
// CMS Azbn.ru Публичная версия

class Login
{
public $class_name='login';

	function __construct()
	{
		//$_SESSION['tmp']['back_url']=$_SERVER['REQUEST_URI'];
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
		
	public function index(&$param)
	{
		$param['page_html']['seo']=$this->FE->CMS->getSEO(3);
		
		$this->FE->load(array('path'=>$this->FE->config['app_path'],'class'=>'Viewer','var'=>'Viewer'));
		$this->FE->Viewer->startofpage($param);
		$this->FE->Viewer->form('login/index',$param);
		$this->FE->Viewer->endofpage($param);
		}
	
	public function start($param)
	{
		$this->loadPluginMng();
		
		$login=$this->FE->_post('login');
		$pass=$this->FE->hash($this->FE->_post('pass'),$login,$this->FE->version['secret']);
		$user_id=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_user']."` WHERE status=1 AND login='$login' AND pass='$pass'");
		if($user_id['id']) {
			
			$log_id=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_log'],array(
				'created_at'=>$this->FE->date,
				'user'=>$user_id['id'],
				'el_id'=>$user_id['id'],
				'el_type'=>'user',
				'type'=>'login',
				'param'=>serialize(array())
				));
			
			$_SESSION['user']=$user_id;
			$_SESSION['user']['param']=unserialize($user_id['param']);
			$_SESSION['user']['right']=explode(',',$user_id['right']);
			if(count($_SESSION['user']['right'])) {
				$right=$_SESSION['user']['right'];
				unset($_SESSION['user']['right']);
				$_SESSION['user']['right']=array();
				foreach($right as $right_id) {
					$_SESSION['user']['right'][$right_id]=1;
					}
				}
			
			$this->FE->PluginMng->event('login:start:after_ok', $param);
			
			$this->FE->go2('/admin/');
			
			} else {
				
				$this->FE->PluginMng->event('login:start:after_notok', $param);
				$_SESSION['tmp']['error']='Вы не смогли войти под логином '.$login.'. Проверьте введенные данные.';
				$this->FE->go2('/login/index/');
				
				}
		}
	
	public function off(&$param)
	{
		$this->loadPluginMng();
		
		$this->FE->PluginMng->event('login:off:before_unset', $param);
		$_SESSION=array();
		unset($_SESSION);
		$this->FE->go2('/');
		}
	
}

?>