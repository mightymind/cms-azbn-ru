<?
// CMS Azbn.ru Публичная версия

class Search
{
public $class_name='search';

	function __construct()
	{

		}
	
	public function index(&$param)
	{
		$this->FE->go2('/'.$param['req_arr']['cont'].'/all/');
		}
	
	public function fulltext(&$param)
	{
		$this->FE->CMS->loadPluginMng($this->class_name);
		
		$param['ftsearch']['text']=mb_strtolower($this->FE->_get('text'), $this->FE->config['charset']);
		//$param['item_id']['title']=$param['item_id']['text'];
		
		$param['page_html']['seo']=$this->FE->CMS->getSEO(5,array(
			'{%title%}'=>$param['ftsearch']['text'],
			'{%description%}'=>$param['ftsearch']['text'],
			'{%keywords%}'=>$param['ftsearch']['text'],
			));
		
		$param['ftsearch_list']=$this->FE->DB->dbSelect("SELECT
				entity,
				el_type,
				el_id,
				updated_at,
				MATCH (main_info) AGAINST ('{$param['ftsearch']['text']}' IN BOOLEAN MODE) as REL
			FROM `".$this->FE->DB->dbtables['t_ftsearch']."`
			WHERE
				visible='1'
				AND
				(
				MATCH (main_info) AGAINST ('{$param['ftsearch']['text']}' IN BOOLEAN MODE) > 0
				OR
				main_info LIKE '%{$param['ftsearch']['text']}%'
				)
			ORDER BY
				REL DESC,
				rating,
				updated_at DESC");
		
		$param['item_list']=array();
		if(mysql_num_rows($param['ftsearch_list'])) {
			
			$alias_arr=array();
			$alias_list=$this->FE->DB->dbSelect("SELECT * FROM `".$this->FE->DB->dbtables['t_alias']."` ORDER BY id");
			while($row=mysql_fetch_array($alias_list)) {
				$alias_arr[$row['to']]=$row['req'];
			}
			
			$entity_arr=array();
			$param['entity_list']=$this->FE->DB->dbSelect("SELECT * FROM `".$this->FE->DB->dbtables['t_entity']."` ORDER BY id");
			while($row=mysql_fetch_array($param['entity_list'])) {
				$entity_arr[$row['id']]=$row;
			}
			mysql_data_seek($param['entity_list'],0);
			
			while($row=mysql_fetch_array($param['ftsearch_list'])) {
				
				switch($row['el_type']) {
					
					case 'entityitem':{
						$table=$this->FE->config['mysql_prefix'].'_'.$entity_arr[$row['entity']]['url'];
						$url_tpl='/entity/item/'.$entity_arr[$row['entity']]['url'].'/{%url%}/';
						$type=$entity_arr[$row['entity']]['url'];
					}
					break;
					
					case 'entitycat':{
						$table=$this->FE->config['mysql_prefix'].'_'.$entity_arr[$row['entity']]['url'].'cat';
						$url_tpl='/entity/cat/'.$entity_arr[$row['entity']]['url'].'/{%url%}/';
						$type=$entity_arr[$row['entity']]['url'].'cat';
					}
					break;
					
					case 'pagecat': {
						$table=$this->FE->DB->dbtables['t_'.$row['el_type']];
						$url_tpl='/page/cat/{%url%}/';
						$type=$row['el_type'];
					}
					break;
					
					case 'postcat': {
						$table=$this->FE->DB->dbtables['t_'.$row['el_type']];
						$url_tpl='/post/cat/{%url%}/';
						$type=$row['el_type'];
					}
					break;
					
					case 'newscat': {
						$table=$this->FE->DB->dbtables['t_'.$row['el_type']];
						$url_tpl='/news/cat/{%url%}/';
						$type=$row['el_type'];
					}
					break;
					
					case 'productcat': {
						$table=$this->FE->DB->dbtables['t_'.$row['el_type']];
						$url_tpl='/product/cat/{%url%}/';
						$type=$row['el_type'];
					}
					break;
					
					case 'geopointcat': {
						$table=$this->FE->DB->dbtables['t_'.$row['el_type']];
						$url_tpl='/geopoint/cat/{%url%}/';
						$type=$row['el_type'];
					}
					break;
					
					default:{
						$table=$this->FE->DB->dbtables['t_'.$row['el_type']];
						$url_tpl='/'.$row['el_type'].'/item/{%url%}/';
						$type=$row['el_type'];
					}
					break;
					
				}
				
				$item=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `$table` WHERE id='{$row['el_id']}' AND visible='1'");
				
				if($item['id']) {
					
					$to=strtr($url_tpl,array(
						'{%url%}'=>$item['url'],
						'{%id%}'=>$item['id'],
						));
					
					if($alias_arr[$to]) {
						$item['url']=$alias_arr[$to];
					} else {
						$item['url']=$to;
					}
					
					$item['ftsearch']=$row;
					$item['ftsearch']['el_type']=$type;
					$param['item_list'][]=$item;
					$param['ftsearch']['count'][$type]++;
					$param['ftsearch']['count']['all']++;
				}
			}
			mysql_data_seek($param['ftsearch_list'],0);
		}
		
		$this->FE->PluginMng->event('search:fulltext:after', $param);
		
		$this->FE->load(array('path'=>$this->FE->config['app_path'],'class'=>'Viewer','var'=>'Viewer'));
		$this->FE->Viewer->startofpage($param);
		$this->FE->Viewer->form('search/fulltext',$param);
		$this->FE->Viewer->endofpage($param);
		
		}
	
}

?>