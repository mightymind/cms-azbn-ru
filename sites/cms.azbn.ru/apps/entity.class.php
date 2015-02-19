<?
// CMS Azbn.ru Публичная версия

class Entity
{
public $class_name='entity';

	function __construct()
	{

		}
		
	public function index(&$param)
	{
		
		}
	
	public function cat(&$param)
	{
		$entity=$this->FE->c_s($param['req_arr']['param_1']);
		
		if($this->FE->is_num($param['req_arr']['param_2'])) {
			$uid=$this->FE->as_int($param['req_arr']['param_2']);
			$uid_str='id';
		} else {
			$uid=$this->FE->c_s($param['req_arr']['param_2']);
			$uid_str='url';
		}
		
		$param['entity']=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_entity']."` WHERE url='$entity'");
		$param['entity']['param']=unserialize($param['entity']['param']);
		
		$table_list=$this->FE->config['mysql_prefix'].'_'.$param['entity']['url'];
		$table=$table_list.'cat';
		
		$param['cat_id']=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$table."` WHERE ($uid_str='$uid' AND visible='1')");
		$param['item_list']=$this->FE->DB->dbSelect("SELECT * FROM `".$table_list."` WHERE cat='{$param['cat_id']['id']}' AND visible='1' ORDER BY rating");
		
		//$param['page_html']['seo']=$this->FE->CMS->getSEO($param['cat_id']['seo']);
		
		$this->FE->load(array('path'=>$this->FE->config['app_path'],'class'=>'Viewer','var'=>'Viewer'));
		$this->FE->Viewer->startofpage($param);
		$this->FE->Viewer->form($param['req_arr']['cont'].'/cat',$param);
		$this->FE->Viewer->endofpage($param);
		}
	
	public function item(&$param)
	{
		$entity=$this->FE->c_s($param['req_arr']['param_1']);
		if($this->FE->is_num($param['req_arr']['param_2'])) {
			$uid=$this->FE->as_int($param['req_arr']['param_2']);
			$uid_str='id';
		} else {
			$uid=$this->FE->c_s($param['req_arr']['param_2']);
			$uid_str='url';
		}
		
		$param['entity']=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_entity']."` WHERE url='$entity'");
		$param['entity']['param']=unserialize($param['entity']['param']);
		
		$table=$this->FE->config['mysql_prefix'].'_'.$param['entity']['url'];
		
		$param['item_id']=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$table."` WHERE ($uid_str='$uid' AND visible='1')");
		$param['cat_id']=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$table."cat` WHERE (id='{$param['item_id']['cat']}')");
		
		//$param['page_html']['seo']=$this->FE->CMS->getSEO($param['item_id']['seo']);
		
		$this->FE->load(array('path'=>$this->FE->config['app_path'],'class'=>'Viewer','var'=>'Viewer'));
		$this->FE->Viewer->startofpage($param);
		if($param['item_id']['id']) {
			$param['item_id']['param']=unserialize($param['item_id']['param']);
			$this->FE->Viewer->form($param['req_arr']['cont'].'/item',$param);
			} else {
				$this->FE->Viewer->form('no',$param);
				}
		$this->FE->Viewer->endofpage($param);
		}
	
}

?>