<?
if($_SESSION['user']['right']['change_news_edit']) {
?>
<script>
$(document).ready(function(){
	$('select[name="visible"]').val(<?=$param['edit_el']['visible'];?>);
	$('select[name="parent"]').val(<?=$param['edit_el']['cat'];?>);
	$('select[name="user"]').val(<?=$param['edit_el']['user'];?>);
	$('select[name="seo"]').val(<?=$param['edit_el']['seo'];?>);
	});
</script>
<div class="page-header" >
	<h3>Обновление новости</h3>
</div>

<div class="row" >
	
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
		
		<?
		$this->FE->Viewer->form('admin/is_backup_check_html',$param);
		?>
		
		<form action="/admin/update/news/<?=$param['edit_el']['id'];?>/" method="POST" >
			
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
			if($_SESSION['user']['right']['change_news_superuser']) {
				$this->FE->Viewer->form('admin/user_select_html',$param);
				}
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
						<input type="text" class="datepicker form-control" name="date" value="<?=date("m/d/Y",$param['edit_el']['date']);?>" />
					</div>
					
					<div class="form-group">
						<label for="time" >Время начала (формат 23:59:59)</label>
						<input type="text" class="form-control maskedinput-time" name="time" value="<?=date("H:i:s",$param['edit_el']['date']);?>" />
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
					'src'=>$param['edit_el']['img'],
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
					'value'=>$param['edit_el']['main_info'],
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
			
			<div class="form-group">
				<button type="submit" class="btn btn-success" >Обновить новость</button>
			</div>
		
		</form>
		
		<?
		$this->FE->Viewer->form('admin/backup_list_html',$param);
		?>
	
		<div class="clear">&nbsp;</div>
	</div>
		
	<div class="clear">&nbsp;</div>
</div>
<?
	}
?>