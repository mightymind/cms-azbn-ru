<?
// CMS Azbn.ru Публичная версия

class Uplfile
{
public $class_name='uplfile';

	function __construct()
	{

		}
		
	public function index(&$param)
	{
		$this->FE->go2('/');
		}
	
	public function item(&$param)
	{
		$id=$this->FE->as_int($param['req_arr']['param_1']);
		$param['item_id']=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_'.$param['req_arr']['cont']]."` WHERE (id='$id')");
		if (!file_exists('.'.$param['item_id']['url'])) {
			Header('HTTP/1.0 404 Not Found');
			exit;
			} elseif($param['item_id']['id']) {
				set_time_limit(0);
				$this->FE->DB->dbUpdate($this->FE->DB->dbtables['t_'.$param['req_arr']['cont']],'clicked=clicked+1',"WHERE id='{$id}'");
				Header('Cache-Control: private');
				Header('Content-Type: application/octet-stream');
				Header('Content-Disposition: attachment; filename="'.$param['item_id']['title'].'"');
				header('Content-Length: '.$param['item_id']['size']);
				Header('Content-Transfer-Encoding: binary');
				//Header('Accept-Ranges: bytes');
				readfile('.'.$param['item_id']['url']);
				}
		}
	
}

?>