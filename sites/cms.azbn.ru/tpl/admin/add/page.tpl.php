<?
if($_SESSION['user']['right']['change_page_add']) {
?>
<script>
$(document).ready(function(){
	//$('select[name="visible"]').val();
	$('select[name="parent"]').val(<?=$this->FE->as_int($_GET['cat']);?>);
	});
</script>
<div class="page-header" >
	<h3>Создание страницы</h3>
</div>

<div class="row" >
	
	<div class="col-sm-12 col-lg-12" >
		
		<form action="/admin/create/page/" method="POST" >
			
			<?
			$this->FE->Viewer->form('admin/title_input_html',$param);
			?>
			
			<?
			$this->FE->Viewer->form('admin/url_input_html',$param);
			?>
			
			<?
			$this->FE->Viewer->form('admin/visible_select_html',$param);
			?>
			
			<?
			$this->FE->Viewer->form('admin/pagecat_select_html',$param);
			?>
			
			<?
			$this->FE->Viewer->form('admin/seo_select_html',$param);
			?>
			
			<?
			$this->FE->Viewer->form('admin/rating_input_html',$param);
			?>
			
			<div class="form-group">
				<label for="img" >Изображение</label>
			<?
				$param['img_form']=array(
					'name'=>'img',
					'src'=>'/img/cms.azbn.ru/default.png',
					'w'=>170,
					'h'=>170,
					'max_w'=>1000,
					'max_h'=>1000,
					'crop'=>1,
					'gray'=>0,
					'path'=>'page/img',
					);
				$this->FE->Viewer->form('admin/avatar_upload_html',$param);
				?>
			</div>
			
			<?
			$this->FE->Viewer->form('admin/yt_video_input_html',$param);
			?>
			
			<?
			$this->FE->Viewer->form('admin/preview_textarea_html',$param);
			?>
			
			<?
			//$param['upload_path']='page/main_info';
			//$this->FE->Viewer->form('admin/form_editor_html',$param);
			//$param['upload_path']='import/ckeditor';
			
			//$param['element_name']='main_info';
			//$param['element_value']='<p></p>';
			//$this->FE->Viewer->form('admin/form_editor_html',$param);
			
			$param['run_editor']=array(
				'element'=>array(
					'name'=>'main_info',
					'value'=>'<p></p>',
					'upload_path'=>'page/main_info',
					),
				);
			$this->FE->Viewer->form('admin/form_editor_html',$param);
			?>
			
			<?
			$this->FE->Viewer->form('admin/tag_input_html',$param);
			?>
			
			<?
			$this->FE->Viewer->form('admin/gal_select_html',$param);
			?>
			
			<?
			$this->FE->Viewer->form('admin/filter_checkbox_list_html',$param);
			?>
			
			<?
			$this->FE->PluginMng->event('admin:viewer:before_create_btn', $param);
			?>
			
			<div class="form-group">
				<button type="submit" class="btn btn-success" >Создать запись</button>
			</div>
		
		</form>
	
		<div class="clear">&nbsp;</div>
	</div>
		
	<div class="clear">&nbsp;</div>
</div>
<?
	}
?>