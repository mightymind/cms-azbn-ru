<?
// CMS Azbn.ru Публичная версия

class Go2
{
public $class_name='go2';

	function __construct()
	{

		}
		
	public function index(&$param)
	{
		
		}
	
	public function back(&$param)
	{
		$this->FE->go2($_SESSION['back_url']);
		}
	
}

?>