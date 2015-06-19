<?
// CMS Azbn.ru Публичная версия

class HotUserTasksOfAdmin
{
public $config = array();
public $dbtables = array();
//public $PluginMng = null;
public $FE = null;

	function __construct($config, &$FE)
	{
		$this->config = $config;
		$this->FE = &$FE;
	}
	
	public function onEvent($event, &$param)
	{
		switch($event) {
			
			case 'admin:viewer:leftcol_widget':{
				$param['mdl']['hotusertasksofadmin']='admin/hotusertasksofadmin';
				$this->FE->Viewer->module_live('hotusertasksofadmin',$param);
			}
			break;
			
			default:{
				echo '<!-- unreg event -->';
			}
			break;
			
		}
	}
	
	public function install(&$param)
	{
		//$this->FE->
		@copy('http://azbn.ru/download/azbn.ru/pluginstore/0/hotusertasksofadmin/hotusertasksofadmin.mdl.php.source', 'sites/'.$this->FE->config['site'].'/module/admin/hotusertasksofadmin.mdl.php');
	}
	
	public function uninstall(&$param)
	{
		//$this->FE->
	}
	
}

?>