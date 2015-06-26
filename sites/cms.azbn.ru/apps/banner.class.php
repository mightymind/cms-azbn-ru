<?
// CMS Azbn.ru Публичная версия

class Banner
{
public $class_name='banner';

	function __construct()
	{
		
		}
		
	public function index(&$param)
	{
		$this->FE->go2('/');
		}
	
	public function item(&$param)
	{
		$uid=$this->FE->as_int($param['req_arr']['param_1']);
		$param['item_id']=$this->FE->DB->dbSelectFirstRow("SELECT id,url FROM `{$this->FE->DB->dbtables['t_banner']}` WHERE id='{$uid}'");
		if($param['item_id']['id']) {
			$this->FE->PluginMng->event('cms:item_id:after_select', $param);
			
			$this->FE->DB->dbUpdate($this->FE->DB->dbtables['t_banner'],'clicked=clicked+1',"WHERE id='{$uid}'");
			$this->FE->go2($param['item_id']['url']);
		}
	}
	
}

?>