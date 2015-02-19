<?
// CMS Azbn.ru Публичная версия
/*
жесткая привязка к mmForEach
*/

class CMSAzbn
{

public $debug;

	function __construct()
	{
		
		}
	
	/*
	Работа с t_param
	*/
	
	public function getParam($param_name)
	{
		$p=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_param']."` WHERE param='$param_name'");
		return $p;
		}
	
	public function getParamValue($param_name)
	{
		$p=$this->getParam($param_name);
		if($p['id']) {
			$p=$p['value'];
			} else {
				$p=null;
				}
		return $p;
		}
	
	public function getParamValueAsArr($param_name)
	{
		return unserialize($this->getParamValue($param_name));
		}
	
	public function setParamValue($param_name,$param_value)
	{
		$p=$this->getParam($param_name);
		if($p['id']) {
			$this->FE->DB->dbUpdate($this->FE->DB->dbtables['t_param'],"value='$param_value'","WHERE param='$param_name'");
			} else {
				$p=array(
					'param'=>$param_name,
					'value'=>$param_value,
					);
				$p['id']=$this->FE->DB->dbInsertIgnore($this->FE->DB->dbtables['t_param'],$p);
				}
		return $p;
		}
	
	public function deleteParamValue($param_name)
	{
		$this->FE->DB->dbDelete($this->FE->DB->dbtables['t_param'],"WHERE param='$param_name'");
		return null;
		}
	
	/*
	/Работа с t_param
	*/
	
	
	
	/*
	Работа с URL
	*/
	
	/*
	public function getAlias($req)
	{
		$alias=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_alias']."` WHERE req='$req'");
		if($alias['id']) {
			
			} else {
				$alias['to']=$req;
				}
		return $alias;
		}
	
	public function genAlias($to)
	{
		$alias=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_alias']."` WHERE `to`='$to'");
		if($alias['id']) {
			$str=$alias['req'];
			} else {
				$str=$to;
				}
		return $str;
		}
	*/
	
	public function getAlias($req)
	{
		if(isset($this->FE->config['alias']['list'][$req])) {
			$alias=$this->FE->config['alias']['list'][$req];
		} elseif(isset($this->FE->config['alias']['similar'])) {
			$alias=array('to'=>strtr($req,$this->FE->config['alias']['similar']));
		} else {
			$alias=array('to'=>$req);
		}
		return $alias;
	}
	
	public function genAlias($to)
	{
		/*
		$key=array_search($to,$this->FE->config['alias']['sure']);
		if($key)
			$str=$this->FE->config['alias']['sure'][$key];
		*/
		$str='';
		$arr=array_flip($this->FE->config['alias']['sure']);
		if(isset($arr[$to])) {
			$str=$arr[$to];
		} elseif(isset($this->FE->config['alias']['similar'])) {
			$arr=array_flip($this->FE->config['alias']['similar']);
			$str=strtr($to,$arr);
		} else {
			$str=$to;
		}
		return $str;
	}
	
	public function setAlias($a=array('req'=>'','type'=>'','to'=>''))
	{
		$p=$this->getAlias($a['req']);
		if($p['id']) {
			$this->FE->DB->dbUpdate($this->FE->DB->dbtables['t_alias'],"type='{$a['type']}',to='{$a['param']}'","WHERE id='{$p['id']}'");
			} else {
				$p=array(
					'type'=>$a['type'],
					'req'=>$a['req'],
					'to'=>$a['to'],
					);
				$p['id']=$this->FE->DB->dbInsertIgnore($this->FE->DB->dbtables['t_alias'],$p);
				}
		return $p;
		}
	
	public function deleteAlias($req)
	{
		$this->FE->DB->dbDelete($this->FE->DB->dbtables['t_alias'],"WHERE req='$req'");
		return null;
		}
	
	public function getReqParams() //$config=array()
	{
		$this->FE->config['alias']=$this->getParamValueAsArr('cms_alias_array');
		$req_arr_=explode("?", $this->FE->_server('REQUEST_URI'));
		
		$alias=$this->getAlias($req_arr_[0]);
		$req_arr_[0]=$alias['to'];
		
		$req_arr=array();
		@list(
			$req_arr['null'],
			$req_arr['cont'],
			$req_arr['func'],
			$req_arr['param_1'],
			$req_arr['param_2'],
			$req_arr['param_3'],
			$req_arr['param_4'],
			$req_arr['param_5'],
			$req_arr['param_6'],
			)=explode("/", $req_arr_[0].'//////////');
		unset($req_arr_);
		
		if($req_arr['cont']) {
			$r_class=$req_arr['cont'];
			} else {
				$req_arr['cont']=$this->FE->config['main_app'];
				$r_class=$this->FE->config['main_app'];
				}
		if($req_arr['func']) {
			$r_func=$req_arr['func'];
			} else {
				$req_arr['func']=$this->FE->config['main_app_function'];
				$r_func=$this->FE->config['main_app_function'];
				}
		$r_type=$this->FE->config['main_app_content_type'];
		
		if(isset($alias['id'])) {
			$r_type=$alias['type'];
			}
		
		return array(
			'content_type'=>$r_type,
			'class'=>$r_class,
			'function'=>$r_func,
			'req_arr'=>$req_arr,
			);
		}
	
	/*
	/Работа с URL
	*/
	
	/*
	Генерация ссылок на лету
	*/
	
	public function getLink(&$row,$el_type='page',$by_url=true)
	{
		switch($el_type) {
			
			case 'entityitem':{$str="/entity/item/{%entity%}/{%uid%}/";} break;
			case 'entitycat':{$str="/entity/cat/{%entity%}/{%uid%}/";} break;
			
			case 'page':{$str="/page/item/{%uid%}/";} break;
			case 'pagecat':{$str="/page/cat/{%uid%}/";} break;
			
			case 'post':{$str="/post/item/{%uid%}/";} break;
			case 'postcat':{$str="/post/cat/{%uid%}/";} break;
			
			case 'news':{$str="/news/item/{%uid%}/";} break;
			case 'newscat':{$str="/news/cat/{%uid%}/";} break;
			
			case 'geopoint':{$str="/geopoint/item/{%uid%}/";} break;
			case 'geopointcat':{$str="/geopoint/cat/{%uid%}/";} break;
			
			case 'product':{$str="/product/item/{%uid%}/";} break;
			case 'productcat':{$str="/product/cat/{%uid%}/";} break;
			
			case 'gallery':{$str="/gallery/item/{%uid%}/";} break;
			//case 'galleryitem':{$str="/galleryitem/item/{%uid%}/";} break;
			
			case 'calendar':{$str="/calendar/item/{%uid%}/";} break;
			
			case 'faq':{$str="/faq/item/{%uid%}/";} break;
			case 'feedback':{$str="/feedback/item/{%uid%}/";} break;
			
			default:{$str="/$el_type/item/{%uid%}/";} break;
			
		}
		
		if($by_url) {
			return strtr($str,array(
				'{%uid%}'=>$row['url'],
				'{%entity%}'=>$row['entity'],
				));
		} else {
			return strtr($str,array(
				'{%uid%}'=>$row['id'],
				'{%entity%}'=>$row['entity'],
				));
		}
	}
	
	public function genLink(&$row,$el_type='page',$by_url=true,$from_alias=true)
	{
		$url=$this->getLink($row,$el_type,$by_url);
		if($from_alias) {
			return $this->genAlias($url);
		} else {
			return $url;
		}
	}
	
	/*
	/Генерация ссылок на лету
	*/
	
	/*
	Подключение к другой БД
	*/
	
	public function Connect2OtherDB($name='',$config=array())
	{
		$this->FE->load(array('path'=>$this->FE->config['sys_path'],'class'=>'InterfaceDB','var'=>$name),false);
		$this->FE->$name->_init($config);
		return true;
	}
	
	/*
	/Подключение к другой БД
	*/
	
	
	/*
	Установка временной зоны
	*/
	
	public function setTimeZone($zone='Europe/Moscow')
	{
		$zone=isset($_SESSION['user']['param']['timezone'])?$_SESSION['user']['param']['timezone']:(isset($_SESSION['profile']['param']['timezone'])?$_SESSION['profile']['param']['timezone']:$zone);
		@date_default_timezone_set($zone);
		return true;
	}
	
	/*
	/Установка временной зоны
	*/
	
	
	/*
	Работа с данными SEO-продвижения
	*/
	
	public function getSEO($id,$changes=array())
	{
		$_seo=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_seo']."` WHERE id='$id'");
		$seo['id']=$this->FE->as_int($_seo['id']);
		$seo['title']=strtr($_seo['title'],$changes);
		$seo['desc']=strtr($_seo['desc'],$changes);
		$seo['kw']=strtr($_seo['kw'],$changes);
		return $seo;
		}
	
	public function setSEO($id,$seo=array('title'=>'','desc'=>'','kw'=>'',))
	{
		if($id) {
			$this->FE->DB->dbUpdate($this->FE->DB->dbtables['t_seo'],"title='{$seo['title']}', desc='{$seo['desc']}', kw='{$seo['kw']}'","WHERE id='$id'");
			} else {
				$seo['id']=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_seo'],$seo);
				}
		return $seo;
		}
	
	public function deleteSEO($id)
	{
		$this->FE->DB->dbDelete($this->FE->DB->dbtables['t_seo'],"WHERE id='$id'");
		return null;
		}
	
	/*
	/Работа с данными SEO-продвижения
	*/
	
}

?>