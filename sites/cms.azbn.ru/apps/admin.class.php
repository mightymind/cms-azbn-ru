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
	
	public function index(&$param)
	{
		$this->FE->go2('/admin/page/index/');
	}
	
	public function page(&$param)
	{
		$this->FE->CMS->loadPluginMng($this->class_name);
		
		$tpl=$this->FE->c_s($param['req_arr']['param_1']);
		
		$this->FE->load(array('path'=>$this->FE->config['app_path'],'class'=>'Viewer','var'=>'Viewer'));
		$this->FE->Viewer->startofpage($param, 'admin/startofpage');
		$this->FE->Viewer->form('admin/page/'.$tpl,$param);
		$this->FE->Viewer->endofpage($param, 'admin/endofpage');
	}
	
	public function edit_file(&$param)
	{
		$this->FE->CMS->loadPluginMng($this->class_name);
		
		$param['file']=array(
			'name'=>$this->FE->_get('file'),
			'main_info'=>file_get_contents($this->FE->_get('file')),
			);
		$this->FE->load(array('path'=>$this->FE->config['app_path'],'class'=>'Viewer','var'=>'Viewer'));
		$this->FE->Viewer->form('admin/page/edit_file',$param);
	}
	
	public function stop(&$param)
	{
		$this->FE->CMS->loadPluginMng($this->class_name);
		
		$this->FE->PluginMng->event('admin:stop:before_unset', $param);
		
		unset($_SESSION);
		$this->FE->go2('/');
	}
	
	public function upload(&$param)
	{
		$this->FE->CMS->loadPluginMng($this->class_name);
		
		$type=$this->FE->c_s($param['req_arr']['param_1']);
		$param['fe_mdl']['upload']='admin/upload/'.$type;
		$this->FE->mdl('upload',$param);
		
		$this->FE->PluginMng->event('admin:upload:after', $param);
	}
	
	public function create(&$param)
	{
		$this->FE->CMS->loadPluginMng($this->class_name);
		
		$type=$this->FE->c_s($param['req_arr']['param_1']);
		$_id=$this->FE->as_int($param['req_arr']['param_2']);
		
		$param['fe_mdl']['create']='admin/create/'.$type;
		$this->FE->mdl('create',$param);
		
		$param['fe_mdl']['ftsearch_reindex']='admin/ftsearch/reindex';
		$this->FE->mdl('ftsearch_reindex',$param);
		
		if($_id) {
			$entity_id_str="$_id/";
		}
		
		$this->FE->PluginMng->event('admin:create:after', $param);
		
		$this->FE->go2('/admin/all/'.$type.'/'.$entity_id_str);
	}
	
	
/* ---------- Редактирование объектов в БД ---------- */
	public function update(&$param)
	{
		$this->FE->CMS->loadPluginMng($this->class_name);
		
		$type=$this->FE->c_s($param['req_arr']['param_1']);
		$id=$this->FE->as_int($param['req_arr']['param_2']);
		$_id=$this->FE->as_int($param['req_arr']['param_3']);
		$param['new_el_id']=$id;
		
		$param['fe_mdl']['backup']='admin/backup/to_drive';
		$this->FE->mdl('backup',$param);
		
		$param['fe_mdl']['update']='admin/update/'.$type;
		$this->FE->mdl('update',$param);
		
		$param['fe_mdl']['ftsearch_reindex']='admin/ftsearch/reindex';
		$this->FE->mdl('ftsearch_reindex',$param);
		
		if($_id) {
			$entity_id_str="$id/";
		}
		
		$this->FE->PluginMng->event('admin:update:after', $param);
		
		$this->FE->go2('/admin/all/'.$type.'/'.$entity_id_str);
	}
/* ---------- Редактирование объектов в БД ---------- */




/* ---------- Удаление объектов из БД ---------- */
	public function delete(&$param)
	{
		$this->FE->CMS->loadPluginMng($this->class_name);
		
		$type=$this->FE->c_s($param['req_arr']['param_1']);
		$id=$this->FE->c_s($param['req_arr']['param_2']);
		$_id=$this->FE->as_int($param['req_arr']['param_3']);
		$param['new_el_id']=$id;
		
		if($type=='galleryitem') {
			$gal=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_galleryitem']."` WHERE id='{$id}'");
			$gal=$this->FE->as_int($gal['gal']);
		}
		
		$param['fe_mdl']['backup']='admin/backup/to_drive';
		$this->FE->mdl('backup',$param);
		
		$param['fe_mdl']['delete']='admin/delete/'.$type;
		$this->FE->mdl('delete',$param);
		
		$param['fe_mdl']['ftsearch_delete']='admin/ftsearch/delete';
		$this->FE->mdl('ftsearch_delete',$param);
		
		if($_id) {
			$entity_id_str="$id/";
		}
		
		$this->FE->PluginMng->event('admin:delete:after', $param);
		
		if($type=='galleryitem') {
			$this->FE->go2('/admin/edit/gallery/'.$gal.'/#table-of-galleryitem-header');
		} else {
			$this->FE->go2('/admin/all/'.$type.'/'.$entity_id_str);
		}
	}
/* ---------- Удаление объектов из БД ---------- */



/* ---------- Форма редактирования объектов в БД ---------- */
	public function edit(&$param)
	{
		$this->FE->CMS->loadPluginMng($this->class_name);
		
		$type=$this->FE->c_s($param['req_arr']['param_1']);
		$id=$this->FE->c_s($param['req_arr']['param_2']);
		$_id=$this->FE->as_int($param['req_arr']['param_3']);
		
		$param['fe_mdl']['edit']='admin/edit/'.$type;
		$this->FE->mdl('edit',$param);
		
		$this->FE->load(array('path'=>$this->FE->config['app_path'],'class'=>'Viewer','var'=>'Viewer'));
		$param['page_title']='Редактирование записи - '.$this->fe_config['enginetitle'];
		$this->FE->Viewer->startofpage($param, 'admin/startofpage');
		$this->FE->Viewer->form($param['html_tpl'],$param);
		$this->FE->Viewer->endofpage($param, 'admin/endofpage');
	}
	
	public function backup(&$param)
	{
		$this->FE->CMS->loadPluginMng($this->class_name);
		
		$type=$this->FE->c_s($param['req_arr']['param_1']);
		$id=$this->FE->c_s($param['req_arr']['param_2']);
		$_id=$this->FE->as_int($param['req_arr']['param_3']);
		
		$param['backup_el']=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_backup']."` WHERE id='$id'");
		
		$param['fe_mdl']['backup']='admin/backup/'.$type;
		$this->FE->mdl('backup',$param);
		
		$this->FE->load(array('path'=>$this->FE->config['app_path'],'class'=>'Viewer','var'=>'Viewer'));
		$param['page_title']='Редактирование восстановленной записи - '.$this->fe_config['enginetitle'];
		$this->FE->Viewer->startofpage($param, 'admin/startofpage');
		$this->FE->Viewer->form($param['html_tpl'],$param);
		$this->FE->Viewer->endofpage($param, 'admin/endofpage');
		//$param['edit_el']=unserialize(file_get_contents($this->FE->config['backup_path'].'/'.$this->FE->config['site'].'/'.$param['backup_el']['el_type'].'/'.$param['backup_el']['created_at'].'_'.$param['backup_el']['el_id'].'_'.$param['backup_el']['user']));
		//$param['html_tpl']='admin/edit/'.$param['backup_el']['el_type'];
	}
/* ---------- Форма редактирования объектов в БД ---------- */



/* ---------- Форма создания объектов в БД ---------- */
	public function add(&$param)
	{
		$this->FE->CMS->loadPluginMng($this->class_name);
		
		$type=$this->FE->c_s($param['req_arr']['param_1']);
		$id=$this->FE->c_s($param['req_arr']['param_2']);
		$_id=$this->FE->as_int($param['req_arr']['param_3']);
		
		$param['fe_mdl']['add']='admin/add/'.$type;
		$this->FE->mdl('add',$param);
		
		$this->FE->load(array('path'=>$this->FE->config['app_path'],'class'=>'Viewer','var'=>'Viewer'));
		$param['page_title']='Создание записи - '.$this->fe_config['enginetitle'];
		$this->FE->Viewer->startofpage($param, 'admin/startofpage');
		$this->FE->Viewer->form($param['html_tpl'],$param);
		$this->FE->Viewer->endofpage($param, 'admin/endofpage');
	}
/* ---------- Форма создания объектов в БД ---------- */

/* ---------- Все объекты в БД ---------- */
	public function all(&$param)
	{
		$this->FE->CMS->loadPluginMng($this->class_name);
		
		$type=$this->FE->c_s($param['req_arr']['param_1']);
		$id=$this->FE->c_s($param['req_arr']['param_2']);
		$_id=$this->FE->as_int($param['req_arr']['param_3']);
		
		$param['fe_mdl']['all']='admin/all/'.$type;
		$this->FE->mdl('all',$param);
		
		$this->FE->load(array('path'=>$this->FE->config['app_path'],'class'=>'Viewer','var'=>'Viewer'));
		$param['page_title']='Все записи - '.$this->fe_config['enginetitle'];
		$this->FE->Viewer->startofpage($param, 'admin/startofpage');
		$this->FE->Viewer->form($param['html_tpl'],$param);
		$this->FE->Viewer->endofpage($param, 'admin/endofpage');
	}
	/* ---------- Все объекты в БД ---------- */

}

?>