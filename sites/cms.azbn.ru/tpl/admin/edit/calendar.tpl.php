<?
if($_SESSION['user']['right']['change_calendar_edit']) {
?>
<script>
$(document).ready(function(){
	$('select[name="visible"]').val(<?=$param['edit_el']['visible'];?>);
	$('select[name="user"]').val(<?=$param['edit_el']['user'];?>);
	$('select[name="seo"]').val(<?=$param['edit_el']['seo'];?>);
	});
</script>
<div class="page-header" >
	<h3>Обновление события календаря</h3>
</div>

<div class="row" >
	
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
		
		<?
		$this->FE->Viewer->form('admin/is_backup_check_html',$param);
		?>
		
		<form action="/admin/update/calendar/<?=$param['edit_el']['id'];?>/" method="POST" >
			
			<div class="form-group">
				<label for="title" >Заголовок</label>
				<input class="form-control" type="text" name="title" value="<?=$param['edit_el']['title'];?>" />
			</div>
			
			<div class="form-group">
				<label for="url" >URL</label>
				<input class="form-control" type="text" name="url" value="<?=$param['edit_el']['url'];?>" />
			</div>
			
			<div class="form-group">
				<label for="visible" >Видимость</label>
				<select class="form-control" name="visible" >
					<option value="1" >отображать на сайте</option>
					<option value="0" >скрыть запись</option>
				</select>
			</div>
			
			<?
			if($_SESSION['user']['right']['change_calendar_superuser']) {
				$this->FE->Viewer->form('admin/user_select_html',$param);
				}
			?>
			
			<?
			$this->FE->Viewer->form('admin/seo_select_html',$param);
			?>
			
			<div class="form-group">
				<label for="rating" >Рейтинг</label>
				<input type="number" class="form-control" name="rating" max="999999999" min="1" value="<?=$param['edit_el']['rating'];?>" />
			</div>
			
			<div class="row">
				
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" >
					
					<div class="form-group">
						<label for="date" >Дата начала</label>
						<input type="text" class="datepicker form-control" name="date" value="<?=date("m/d/Y",$param['edit_el']['start_at']);?>" />
					</div>
					
					<div class="form-group">
						<label for="time" >Время начала (формат 23:59:59)</label>
						<input type="text" class="form-control maskedinput-time" name="time" value="<?=date("H:i:s",$param['edit_el']['start_at']);?>" />
					</div>
					
				</div>
				
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" >
					
					
					<div class="form-group">
						<label for="sdate" >Дата окончания</label>
						<input type="text" class="datepicker form-control" name="sdate" value="<?=date("m/d/Y",$param['edit_el']['stop_at']);?>" />
					</div>
					
					<div class="form-group">
						<label for="stime" >Время окончания (формат 23:59:59)</label>
						<input type="text" class="form-control" name="stime" value="<?=date("H:i:s",$param['edit_el']['stop_at']);?>" />
					</div>
					
					
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
					'path'=>'calendar/img',
					);
				$this->FE->Viewer->form('admin/avatar_upload_html',$param);
				?>
			</div>
			
			<div class="form-group">
				<label for="param[yt_video]" >Ссылка на страницу видео на YouTube</label>
				<input class="form-control" type="text" name="param[yt_video]" value="http://www.youtube.com/watch?v=<?=$param['edit_el']['param']['yt_video'];?>" />
				
				<?
				if($param['edit_el']['param']['yt_video']) {
				?>
				<p>
					<center>
						<a href="http://www.youtube.com/watch?v=<?=$param['edit_el']['param']['yt_video'];?>" target="_blank" ><img src="<?=$param['edit_el']['param']['yt_img'];?>" /></a>
					</center>
				</p>
				<?
					}
				?>
			</div>
			
			<div class="form-group">
				<label for="preview" >Краткое содержание</label>
				<textarea class="form-control" name="preview" ><?=$param['edit_el']['preview'];?></textarea>
			</div>
			
			<?
			$param['run_editor']=array(
				'element'=>array(
					'name'=>'main_info',
					'value'=>$param['edit_el']['main_info'],
					'upload_path'=>'calendar/main_info',
					),
				);
			$this->FE->Viewer->form('admin/form_editor_html',$param);
			?>
			
			<div class="form-group">
				<label for="tag" >Теги (через точку с запятой!)</label>
				<input class="form-control" type="text" name="tag" value="<?=$param['edit_el']['tag'];?>" />
			</div>
			
			<?
			$this->FE->Viewer->form('admin/gal_select_html',$param);
			?>
			
			<?
			$this->FE->Viewer->form('admin/filter_checkbox_list_html',$param);
			?>
			
			<div class="form-group">
				<button type="submit" class="btn btn-success" >Обновить событие</button>
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