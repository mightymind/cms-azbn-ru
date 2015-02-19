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
	
	public function view(&$param)
	{
		$banner_id=$this->FE->as_int($param['req_arr']['param_1']);
		$banner=$this->FE->DB->dbSelectFirstRow("SELECT id,url FROM `{$this->FE->DB->dbtables['t_banner']}` WHERE id='{$banner_id}'");
		if($banner['id']) {
			$this->FE->DB->dbUpdate($this->FE->DB->dbtables['t_banner'],'clicked=clicked+1',"WHERE id='{$banner_id}'");
			$this->FE->go2($banner['url']);
			}
		}
	
}

?>