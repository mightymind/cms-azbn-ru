<?
if($_SESSION['user']['right']['change_news_add']) {
?>
<script>
$(document).ready(function(){
	$('select[name="parent"]').val(<?=$this->FE->as_int($_GET['cat']);?>);
	});
</script>
<div class="page-header" >
	<h3>Создание новости</h3>
</div>

<div class="row" >
	
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
		
		<form action="/admin/create/news/" method="POST" >
			
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
			$this->FE->Viewer->form('admin/newscat_select_html',$param);
			?>
			
			<?
			$this->FE->Viewer->form('admin/seo_select_html',$param);
			?>
			
			<?
			$this->FE->Viewer->form('admin/rating_input_html',$param);
			?>
			
			<div class="row">
				
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" >
					
					<div class="form-group">
						<label for="date" >Дата</label>
						<input type="text" class="datepicker form-control" name="date" />
					</div>
					
					<div class="form-group">
						<label for="time" >Время начала (формат 23:59:59)</label>
						<input type="text" class="form-control maskedinput-time" name="time" value="00:00:00" />
					</div>
					
				</div>
				
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" >
					
					<!--
					<div class="form-group">
						<label for="sdate" >Дата начала</label>
						<input type="text" class="datepicker form-control" name="sdate" />
					</div>
					
					<div class="form-group">
						<label for="stime" >Время окончания (формат 23:59:59)</label>
						<input type="text" class="form-control" name="stime" value="00:00:00" />
					</div>
					-->
					
				</div>
				
			</div>
			
			<div class="form-group">
				<label for="img" >Изображение</label>
			<?
				$param['img_form']=array(
					'name'=>'img',
					'src'=>'/img/cms.azbn.ru/default.png',
					'w'=>170,
					'h'=>170,
					'crop'=>1,
					'gray'=>0,
					'path'=>'news/img',
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
			$param['run_editor']=array(
				'element'=>array(
					'name'=>'main_info',
					'value'=>'<p></p>',
					'upload_path'=>'news/main_info',
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
				<button type="submit" class="btn btn-success" >Создать новость</button>
			</div>
		
		</form>
	
		<div class="clear">&nbsp;</div>
	</div>
		
	<div class="clear">&nbsp;</div>
</div>
<?
	}
?>