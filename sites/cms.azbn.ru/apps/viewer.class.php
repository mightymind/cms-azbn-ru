<?
// CMS Azbn.ru Публичная версия

class Viewer
{
public $class_name='viewer';

	function __construct()
	{
		$_SESSION['tmp']['back_url']=$_SERVER['REQUEST_URI'];
	}

	public function form($tpl,&$param)
	{
		require('sites/'.$this->FE->config['site'].'/tpl/'.$tpl.'.tpl.php');
	}
	
	public function module($tpl,&$param,$period=900)
	{
		if($param['mdl'][$tpl]) {
			
			$uid = 'mdl_'.$param['mdl'][$tpl].'_'.$this->FE->config['site'];
			$cache=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_cache']."` WHERE (uid='$uid' AND clear_at>'{$this->FE->date}')");
			
			if($cache['id']) {
				
			} else {
				
				$this->FE->Cache->start_caching();
				require('sites/'.$this->FE->config['site'].'/module/'.$param['mdl'][$tpl].'.mdl.php');
				$cache=array(
					'created_at'=>$this->FE->date,
					'clear_at'=>($this->FE->date+$period),
					'uid'=>$uid,
					'text'=>($this->FE->Cache->get_caching_content()), // mysql_escape_string($this->FE->Cache->get_caching_content())
					);
				$this->FE->Cache->finish_caching();
				$cache['id']=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_cache'],$cache);
				
			}
			
			echo $cache['text'];
		}
	}

	public function module_live($tpl,&$param)
	{
		if($param['mdl'][$tpl]) {
			require('sites/'.$this->FE->config['site'].'/module/'.$param['mdl'][$tpl].'.mdl.php');
		}
	}
	
	public function startofpage(&$param, $tpl='startofpage')
	{
		if($tpl!=''){
			if(!$param['page_html']['seo']['id']) {
				if($param['item_id']['seo']) {
					$param['page_html']['seo']=$this->FE->CMS->getSEO($param['item_id']['seo'],array(
						'{%title%}'=>$param['item_id']['title'],
						'{%description%}'=>$param['item_id']['preview'],
						'{%keywords%}'=>$param['item_id']['tag'],
						));
				} elseif($param['cat_id']['seo']) {
					$param['page_html']['seo']=$this->FE->CMS->getSEO($param['cat_id']['seo'],array(
						'{%title%}'=>$param['cat_id']['title'],
						'{%description%}'=>$param['cat_id']['preview'],
						'{%keywords%}'=>$param['cat_id']['tag'],
						));
				} else {
					
				}
			}
			$this->form($tpl,$param);
		}
	}
	
	public function endofpage(&$param, $tpl='endofpage')
	{
		if($tpl!=''){
			$this->form($tpl,$param);
		}
	}
	/*
	public function linetpl(&$param, $tpl_arr=array())
	{
		if(count($tpl_arr)) {
			foreach($tpl_arr as $tpl) {
				$this->form($tpl,$param);
			}
		}
	}
	*/
	public function view_banner($banner=array('view_at'=>999999999, 'tpl'=>'banner/default', 'limit'=>1, 'cache_time'=>3600, 'order_by'=>'rating'),&$param)
	{
		$param['banner_list']=$this->FE->DB->dbSelect("SELECT * FROM `".$this->FE->DB->dbtables['t_banner']."` WHERE view_at='{$banner['view_at']}' ORDER BY {$banner['order_by']} LIMIT {$banner['limit']}");
		$param['mdl']['banner_tpl']=$banner['tpl'];
		$this->module('banner_tpl',$param,$banner['cache_time']);
	}
	
	public function returnStrOrNbsp($str='')
	{
		return (mb_strlen($str, $this->FE->config['charset'])?$str:'&nbsp;');
	}
	
}

?>