<?
// CMS Azbn.ru Публичная версия

class AzbnPluginInstaller
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
			
			case 'admin:viewer:menu_plugin_list':{
				echo '<li><a href="/admin/page/azbnplugininstaller/" >AzbnPluginInstaller</a></li>';
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
		@copy('http://azbn.ru/download/azbn.ru/pluginstore/0/azbnplugininstaller/azbnplugininstaller.tpl.php.source', 'sites/'.$this->FE->config['site'].'/tpl/admin/page/azbnplugininstaller.tpl.php');
	}
	
	public function uninstall(&$param)
	{
		//$this->FE->
	}
	
}

?>