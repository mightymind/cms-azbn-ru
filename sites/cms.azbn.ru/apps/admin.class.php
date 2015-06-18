<?
// CMS Azbn.ru Публичная версия

class Admin
{
public $class_name='admin';

	function __construct()
	{
		if(!$_SESSION['user']['id'] || !$_SESSION['user']['right']['is_admin']) {
			Header('Location: /login/');
			}
		}
	
	public function loadPluginMng()
	{
		if(!isset($this->FE->PluginMng) || $this->FE->PluginMng==null) {
			$this->FE->load(array('path'=>$this->FE->config['app_path'],'class'=>'Pluginmng','var'=>'PluginMng'));
			$this->FE->PluginMng->loadPlugins($this->class_name);
		}
	}
	
	public function index(&$param)
	{
		$this->FE->go2('/admin/page/index/');
		}
	
	public function page(&$param)
	{
		$this->loadPluginMng();
		//$this->FE->PluginMng->event('test_event', $param);
		$this->FE->PluginMng->event('admin_page_start', $param);
		$tpl=$this->FE->c_s($param['req_arr']['param_1']);
		$this->FE->PluginMng->event('admin_page_load_viewer', $param);
		$this->FE->load(array('path'=>$this->FE->config['app_path'],'class'=>'Adminviewer','var'=>'Viewer'));
		$this->FE->PluginMng->event('admin_page_startofpage', $param);
		$this->FE->Viewer->startofpage($param);
		$this->FE->PluginMng->event('admin_page_form', $param);
		$this->FE->Viewer->form('admin/page/'.$tpl,$param);
		$this->FE->PluginMng->event('admin_page_endofpage', $param);
		$this->FE->Viewer->endofpage($param);
		$this->FE->PluginMng->event('admin_page_stop', $param);
		}
	
	public function edit_file(&$param)
	{
		$this->loadPluginMng();
		
		$this->FE->PluginMng->event('admin_edit_file_start', $param);
		$param['file']=array(
			'name'=>$this->FE->_get('file'),
			'main_info'=>file_get_contents($this->FE->_get('file')),
			);
		$this->FE->PluginMng->event('admin_edit_file_load_viewer', $param);
		$this->FE->load(array('path'=>$this->FE->config['app_path'],'class'=>'Adminviewer','var'=>'Viewer'));
		$this->FE->PluginMng->event('admin_edit_file_form', $param);
		$this->FE->Viewer->form('admin/page/edit_file',$param);
		$this->FE->PluginMng->event('admin_edit_file_stop', $param);
		}
	
	public function stop(&$param)
	{
		$this->loadPluginMng();
		
		$this->FE->PluginMng->event('admin_stop_start', $param);
		unset($_SESSION);
		$this->FE->go2('/');
		$this->FE->PluginMng->event('admin_stop_stop', $param);
		}
	
	public function upload(&$param)
	{
		$this->loadPluginMng();
		
		$this->FE->PluginMng->event('admin_upload_start', $param);
		$type=$this->FE->c_s($param['req_arr']['param_1']);
		$this->FE->PluginMng->event('admin_upload_mdl', $param);
		$param['fe_mdl']['upload']='admin/upload/'.$type;
		$this->FE->mdl('upload',$param);
		$this->FE->PluginMng->event('admin_upload_stop', $param);
		
		}
	
	public function create(&$param)
	{
		$this->loadPluginMng();
		
		$this->FE->PluginMng->event('admin_create_start', $param);
		
		$type=$this->FE->c_s($param['req_arr']['param_1']);
		//$id=$this->FE->c_s($param['req_arr']['param_2']);
		$_id=$this->FE->as_int($param['req_arr']['param_2']);
		
		$this->FE->PluginMng->event('admin_create_mdl', $param);
		$param['fe_mdl']['create']='admin/create/'.$type;
		$this->FE->mdl('create',$param);
		
		$this->FE->PluginMng->event('admin_create_ftsearch_mdl', $param);
		$param['fe_mdl']['ftsearch_reindex']='admin/ftsearch/reindex';
		$this->FE->mdl('ftsearch_reindex',$param);
		
		if($_id) {
			$entity_id_str="$_id/";
		}
		
		$this->FE->go2('/admin/all/'.$type.'/'.$entity_id_str);
		$this->FE->PluginMng->event('admin_create_stop', $param);
		}
	
	
/* ---------- Редактирование объектов в БД ---------- */
	public function update(&$param)
	{
		$this->loadPluginMng();
		
		$this->FE->PluginMng->event('admin_update_start', $param);
		
		$type=$this->FE->c_s($param['req_arr']['param_1']);
		$id=$this->FE->as_int($param['req_arr']['param_2']);
		$_id=$this->FE->as_int($param['req_arr']['param_3']);
		$param['new_el_id']=$id;
		
		$this->FE->PluginMng->event('admin_update_backup_mdl', $param);
		$param['fe_mdl']['backup']='admin/backup/to_drive';
		$this->FE->mdl('backup',$param);
		
		$this->FE->PluginMng->event('admin_update_mdl', $param);
		$param['fe_mdl']['update']='admin/update/'.$type;
		$this->FE->mdl('update',$param);
		
		$this->FE->PluginMng->event('admin_update_ftsearch_mdl', $param);
		$param['fe_mdl']['ftsearch_reindex']='admin/ftsearch/reindex';
		$this->FE->mdl('ftsearch_reindex',$param);
		
		if($_id) {
			$entity_id_str="$id/";
		}
		
		$this->FE->go2('/admin/all/'.$type.'/'.$entity_id_str);
		$this->FE->PluginMng->event('admin_update_stop', $param);
		}
/* ---------- Редактирование объектов в БД ---------- */




/* ---------- Удаление объектов из БД ---------- */
	public function delete(&$param)
	{
		$this->loadPluginMng();
		
		$this->FE->PluginMng->event('admin_delete_start', $param);
		
		$type=$this->FE->c_s($param['req_arr']['param_1']);
		$id=$this->FE->c_s($param['req_arr']['param_2']);
		$_id=$this->FE->as_int($param['req_arr']['param_3']);
		$param['new_el_id']=$id;
		
		if($type=='galleryitem') {
			$this->FE->PluginMng->event('admin_delete_galleryitem', $param);
			$gal=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_galleryitem']."` WHERE id='{$id}'");
			$gal=$this->FE->as_int($gal['gal']);
		}
		
		$this->FE->PluginMng->event('admin_delete_backup_mdl', $param);
		$param['fe_mdl']['backup']='admin/backup/to_drive';
		$this->FE->mdl('backup',$param);
		
		$this->FE->PluginMng->event('admin_delete_mdl', $param);
		$param['fe_mdl']['delete']='admin/delete/'.$type;
		$this->FE->mdl('delete',$param);
		
		$this->FE->PluginMng->event('admin_delete_ftsearch_mdl', $param);
		$param['fe_mdl']['ftsearch_delete']='admin/ftsearch/delete';
		$this->FE->mdl('ftsearch_delete',$param);
		
		if($_id) {
			$entity_id_str="$id/";
		}
		
		if($type=='galleryitem') {
			$this->FE->go2('/admin/edit/gallery/'.$gal.'/#table-of-galleryitem-header');
		} else {
			$this->FE->go2('/admin/all/'.$type.'/'.$entity_id_str);
		}
		$this->FE->PluginMng->event('admin_delete_stop', $param);
		}
/* ---------- Удаление объектов из БД ---------- */



/* ---------- Форма редактирования объектов в БД ---------- */
	public function edit(&$param)
	{
		$this->loadPluginMng();
		
		$this->FE->PluginMng->event('admin_edit_start', $param);
		
		$type=$this->FE->c_s($param['req_arr']['param_1']);
		$id=$this->FE->c_s($param['req_arr']['param_2']);
		$_id=$this->FE->as_int($param['req_arr']['param_3']);
		
		$this->FE->PluginMng->event('admin_edit_mdl', $param);
		$param['fe_mdl']['edit']='admin/edit/'.$type;
		$this->FE->mdl('edit',$param);
		
		$this->FE->PluginMng->event('admin_edit_load_viewer', $param);
		$this->FE->load(array('path'=>$this->FE->config['app_path'],'class'=>'Adminviewer','var'=>'Viewer'));
		$param['page_title']='Редактирование записи - '.$this->fe_config['enginetitle'];
		$this->FE->PluginMng->event('admin_edit_startofpage', $param);
		$this->FE->Viewer->startofpage($param);
		$this->FE->PluginMng->event('admin_edit_form', $param);
		$this->FE->Viewer->form($param['html_tpl'],$param);
		$this->FE->PluginMng->event('admin_edit_endofpage', $param);
		$this->FE->Viewer->endofpage($param);
		$this->FE->PluginMng->event('admin_edit_stop', $param);
		}
	
	public function backup(&$param)
	{
		$this->loadPluginMng();
		
		$this->FE->PluginMng->event('admin_backup_start', $param);
		
		$type=$this->FE->c_s($param['req_arr']['param_1']);
		$id=$this->FE->c_s($param['req_arr']['param_2']);
		$_id=$this->FE->as_int($param['req_arr']['param_3']);
		
		$this->FE->PluginMng->event('admin_backup_load_el', $param);
		$param['backup_el']=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_backup']."` WHERE id='$id'");
		
		$this->FE->PluginMng->event('admin_backup_mdl', $param);
		$param['fe_mdl']['backup']='admin/backup/'.$type;
		$this->FE->mdl('backup',$param);
		
		$this->FE->PluginMng->event('admin_backup_load_viewer', $param);
		$this->FE->load(array('path'=>$this->FE->config['app_path'],'class'=>'Adminviewer','var'=>'Viewer'));
		$param['page_title']='Редактирование восстановленной записи - '.$this->fe_config['enginetitle'];
		$this->FE->PluginMng->event('admin_backup_startofpage', $param);
		$this->FE->Viewer->startofpage($param);
		$this->FE->PluginMng->event('admin_backup_form', $param);
		$this->FE->Viewer->form($param['html_tpl'],$param);
		$this->FE->PluginMng->event('admin_backup_endofpage', $param);
		$this->FE->Viewer->endofpage($param);
		$this->FE->PluginMng->event('admin_backup_stop', $param);
		//$param['edit_el']=unserialize(file_get_contents($this->FE->config['backup_path'].'/'.$this->FE->config['site'].'/'.$param['backup_el']['el_type'].'/'.$param['backup_el']['created_at'].'_'.$param['backup_el']['el_id'].'_'.$param['backup_el']['user']));
		//$param['html_tpl']='admin/edit/'.$param['backup_el']['el_type'];
		}
/* ---------- Форма редактирования объектов в БД ---------- */



/* ---------- Форма создания объектов в БД ---------- */
	public function add(&$param)
	{
		$this->loadPluginMng();
		
		$this->FE->PluginMng->event('admin_add_start', $param);
		
		$type=$this->FE->c_s($param['req_arr']['param_1']);
		$id=$this->FE->c_s($param['req_arr']['param_2']);
		$_id=$this->FE->as_int($param['req_arr']['param_3']);
		
		$this->FE->PluginMng->event('admin_add_mdl', $param);
		$param['fe_mdl']['add']='admin/add/'.$type;
		$this->FE->mdl('add',$param);
		
		$this->FE->PluginMng->event('admin_add_load_viewer', $param);
		$this->FE->load(array('path'=>$this->FE->config['app_path'],'class'=>'Adminviewer','var'=>'Viewer'));
		$param['page_title']='Создание записи - '.$this->fe_config['enginetitle'];
		$this->FE->PluginMng->event('admin_add_startofpage', $param);
		$this->FE->Viewer->startofpage($param);
		$this->FE->PluginMng->event('admin_add_form', $param);
		$this->FE->Viewer->form($param['html_tpl'],$param);
		$this->FE->PluginMng->event('admin_add_endofpage', $param);
		$this->FE->Viewer->endofpage($param);
		$this->FE->PluginMng->event('admin_add_stop', $param);
		}
/* ---------- Форма создания объектов в БД ---------- */

/* ---------- Все объекты в БД ---------- */
	public function all(&$param)
	{
		$this->loadPluginMng();
		
		$this->FE->PluginMng->event('admin_all_start', $param);
		
		$type=$this->FE->c_s($param['req_arr']['param_1']);
		$id=$this->FE->c_s($param['req_arr']['param_2']);
		$_id=$this->FE->as_int($param['req_arr']['param_3']);
		
		$this->FE->PluginMng->event('admin_all_mdl', $param);
		$param['fe_mdl']['all']='admin/all/'.$type;
		$this->FE->mdl('all',$param);
		
		$this->FE->PluginMng->event('admin_all_load_viewer', $param);
		$this->FE->load(array('path'=>$this->FE->config['app_path'],'class'=>'Adminviewer','var'=>'Viewer'));
		$param['page_title']='Все записи - '.$this->fe_config['enginetitle'];
		$this->FE->PluginMng->event('admin_all_startofpage', $param);
		$this->FE->Viewer->startofpage($param);
		$this->FE->PluginMng->event('admin_all_form', $param);
		$this->FE->Viewer->form($param['html_tpl'],$param);
		$this->FE->PluginMng->event('admin_all_endofpage', $param);
		$this->FE->Viewer->endofpage($param);
		$this->FE->PluginMng->event('admin_all_stop', $param);
		}
	/* ---------- Все объекты в БД ---------- */

}

?>