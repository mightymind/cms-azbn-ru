<?
if($_SESSION['user']['right']['change_feedback_edit']) {
?>
<script>
$(document).ready(function(){
	$('select[name="visible"]').val(<?=$param['edit_el']['visible'];?>);
	//$('select[name="parent"]').val(<?=$param['edit_el']['cat'];?>);
	//$('select[name="user"]').val(<?=$param['edit_el']['user'];?>);
	});
</script>
<div class="page-header" >
	<h3>Редактирование записи обратной связи</h3>
</div>

<div class="row" >
	
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
		
		<?
		$this->FE->Viewer->form('admin/is_backup_check_html',$param);
		?>
		
		<form action="/admin/update/feedback/<?=$param['edit_el']['id'];?>/" method="POST" >
			
			<?
			if($_SESSION['user']['right']['change_feedback_superuser']) {
			?>
			<input type="hidden" name="profile" value="<?=$param['edit_el']['profile'];?>" />
			<?
				}
			?>
			
			<div class="row">
				
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" >
					
					<div class="form-group">
						<label for="date" >Дата создания</label>
						<input type="text" class="datepicker form-control" name="date" value="<?=date("m/d/Y",$param['edit_el']['created_at']);?>" />
					</div>
					
					<div class="form-group">
						<label for="time" >Время создания (формат 23:59:59)</label>
						<input type="text" class="form-control maskedinput-time" name="time" value="<?=date("H:i:s",$param['edit_el']['created_at']);?>" />
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
				<label for="view_as" >Подпись автора</label>
				<input class="form-control" type="text" name="view_as" value="<?=$param['edit_el']['view_as'];?>" />
			</div>
			
			<div class="form-group">
				<label for="phone" >Телефон</label>
				<input class="form-control" type="text" name="phone" value="<?=$param['edit_el']['phone'];?>" />
			</div>
			
			<div class="form-group">
				<label for="email" >E-mail</label>
				<input class="form-control" type="text" name="email" value="<?=$param['edit_el']['email'];?>" />
			</div>
			
			
			<div class="form-group">
				<label for="visible" >Видимость</label>
				<select class="form-control" name="visible" >
					<option value="1" >отображать на сайте</option>
					<option value="0" >скрыть запись</option>
				</select>
			</div>
			
			<?
			$param['run_editor']=array(
				'element'=>array(
					'name'=>'main_info',
					'value'=>$param['edit_el']['main_info'],
					'upload_path'=>'feedback/main_info',
					),
				);
			$this->FE->Viewer->form('admin/form_editor_html',$param);
			?>
			
			<div class="form-group">
				<button type="submit" class="btn btn-success" >Обновить</button>
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