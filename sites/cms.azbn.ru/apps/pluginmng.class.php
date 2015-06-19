<?

class Pluginmng {

public $plugins=array();
public $events=array();
//public $results=array();
//public $PluginMng = null;

	function __construct()
	{
		
	}
	
	public function loadPlugins($tag='', $clear=true)
	{
		if($clear) {
			$this->plugins=array();
			$this->events=array();
			//$this->results=array();
		}
		if($tag!='') {
			$tag_sql="AND (tag LIKE '$tag%')";
		} else {
			$tag_sql='';
		}
		$plugins=$this->FE->DB->dbSelect("SELECT * FROM `".$this->FE->DB->dbtables['t_plugin']."` WHERE status='1' $tag_sql ORDER BY rating, id");
		while($row=mysql_fetch_array($plugins)) {
			$this->load($row);
			if($this->load($row)) {
				if(count($this->plugins[$row['id']]->config['event'])) {
					foreach($this->plugins[$row['id']]->config['event'] as $event) {
						$this->regOnEvent($event, $this->plugins[$row['id']]);
					}
				}
			}
		}
	}
	
	public function load($row)
	{
		if(isset($this->plugins[$row['id']]) && $this->plugins[$row['id']]!=null) {
			
			
			
		} else {
			
			$row['param']=unserialize($row['param']);
			$row['event']=explode(',',$row['event']);
			$file = 'sites/'.$this->FE->config['site'].'/'.$this->FE->config['plugin_path'].'/'.$row['id'].'/main.plugin.php';
			if(file_exists($file)) {
				$name = basename($row['uid']);
				
				if(class_exists($name)) {
					
				} else {
					require_once($file);
				}
				
				if(class_exists($name)) {
					$this->plugins[$row['id']] = new $name($row, $this->FE);
				} else {
					unset($this->plugins[$row['id']]);
				}
				
			} else {
				unset($this->plugins[$row['id']]);
			}
			
		}
		return isset($this->plugins[$row['id']]);
	}
	
	public function unload($id)
	{
		if(isset($this->plugins[$id])) {
			unset($this->plugins[$id]);
		}
	}
	
	public function regOnEvent($event, &$plugin)
	{
		$this->events[$event][$plugin->config['id']] = &$plugin;
	}
	
	public function event($event, &$param)
	{
		if(isset($this->events[$event])) {
			if(count($this->events[$event])) {
				foreach($this->events[$event] as &$plugin) {
					if(isset($plugin)) {
						if(method_exists($plugin, 'onEvent')) {
							//$this->results[$event][$plugin->config['id']] = 
							$plugin->onEvent($event, $param);
						}
					}
				}
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	public function getPluginDirectory($id)
	{
		return 'sites/'.$this->FE->config['site'].'/'.$this->FE->config['plugin_path'].'/'.$id;
	}
	
	public function removePluginDirectory($dir)
	{
		if ($objs = glob($dir."/*")) {
			foreach($objs as $obj) {
				is_dir($obj) ? $this->removePluginDirectory($obj) : @unlink($obj);
			}
		}
		@rmdir($dir);
	}
	
	public function destroy()
	{
		unset($this->plugins);
		unset($this->events);
		//unset($this->results);
		unset($this);
	}

}

?>