<?
// CMS Azbn.ru Публичная версия

class Api
{
/*
---------------------
Формат запроса

/api/call/<FORMAT>?service=<SERVICE>&method=<METHOD>&app_key=<APP_KEY>'&callback=<CALLBACK>'

service
method
app_key
	'count'=int

---------------------
Формат ответа

info - массив служебной информации
	version
	date
	platform
	platform_update
	info_msg
response
	'item_list'=[]
	'item'={}

---------------------
Коды ошибок

0001 - неправильный app_key или незарегистрированное приложение

*/
public $class_name='api';
public $req=array();
public $resp=array(
	'info'=>array(),
	//'request'=>array(),
	'response'=>array()
	);

	function __construct()
	{
		$this->resp['info']=array(
			'version'=>'0.3b',
			'date'=>date("U"),
			'date_str'=>date("Y/m/d H:i:s"),
			'platform'=>'Azbn API',
			'platform_update'=>'2013/09/24 08:52',
			'info_msg'=>''
			);
		$this->resp['req']=array();
		$this->req=&$this->resp['req'];
		$this->resp['response']=array();
	}
		
	public function index(&$param)
	{
		
	}
	
	public function call(&$param)
	{
		$this->FE->CMS->loadPluginMng($this->class_name);
		
		if(count($_GET)) {
			foreach($_GET as $k=>$v) {
				$this->req[$k]=$this->FE->c_s($v);
			}
		}
		if(count($_POST)) {
			foreach($_POST as $k=>$v) {
				$this->req[$k]=$this->FE->c_s($v);
			}
		}
		
		$format=strtolower($this->FE->c_s($param['req_arr']['param_1']));
		
		Header('Access-Control-Allow-Origin: *');
		$this->FE->genHeaders('application/json',true);
		
		$param['api_app']=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_apiapp']."` WHERE (status>0 AND app_key='{$this->req['app_key']}')");
		if($param['api_app']['id']) {
			
			$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_apicall'],array(
				'created_at'=>$this->FE->date,
				'app'=>$param['api_app']['id'],
				'service'=>$this->req['service'],
				'method'=>$this->req['method'],
				'param'=>serialize($this->req)
			));
			
			$param['api_resp']=&$this->resp;
			$param['fe_mdl']['api_call']='api/'.$this->req['service'].'/'.$this->req['method'];
			$this->FE->mdl('api_call',$param);
			
		} else {
			$this->resp['info']['info_msg']='Ошибка доступа приложения (err#0001)';
		}
		
		$this->FE->PluginMng->event('api:call:before_echo', $this->resp);
		
		if($format==='jsonp') {
			echo ($this->req['callback'].'('.$this->FE->arr2json($this->resp).');');
		} else {
			echo ($this->FE->arr2json($this->resp));
		}
		die();
	}
	
	public function admin(&$param)
	{
		$this->FE->CMS->loadPluginMng($this->class_name);
		
		if(count($_POST)) {
			foreach($_POST as $k=>$v) {
				$this->req[$k]=$this->FE->c_s($v);
			}
		}
		
		//Header('Access-Control-Allow-Origin: *');
		$this->FE->genHeaders('application/json',true);
		
		$param['api_app']=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_apiapp']."` WHERE (status>0 AND app_key='{$this->req['app_key']}')");
		if($param['api_app']['id'] && ($this->FE->config['admin_app_key']===$this->req['app_key'])) {
			
			$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_adminapicall'],array(
				'created_at'=>$this->FE->date,
				'app'=>$param['api_app']['id'],
				'service'=>$this->req['service'],
				'method'=>$this->req['method'],
				'param'=>serialize($this->req)
			));
			
			$param['api_resp']=&$this->resp;
			$param['fe_mdl']['api_call']='adminapi/'.$this->req['service'].'/'.$this->req['method'];
			$this->FE->mdl('api_call',$param);
		
		} else {
			$this->resp['info']['info_msg']='Ошибка доступа приложения (err#0001)';
		}
		
		$this->FE->PluginMng->event('api:admin:before_echo', $this->resp);
		
		echo ($this->FE->arr2json($this->resp));
		die();
	}
	
}

?>