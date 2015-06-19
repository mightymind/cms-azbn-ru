<?
// CMS Azbn.ru Публичная версия

class ShowErrorForDebug
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
			
			case 'cms:unload':{
				
				if($this->FE->debug && count($this->FE->error) && $param['class']!='api') {
					echo "<pre>";
					echo "--------- error list ---------\n";
					foreach($this->FE->error as $err) {
						echo $err['id'].': '.$err['file'].' - '.$err['title']."\n";
					}
					echo "</pre>";
				}
				
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
		
	}
	
	public function uninstall(&$param)
	{
		
	}
	
}

?>