<?
// ГдеДостать
if($_SESSION['user']['right']['change_alias']) {
//
?>
<script>
$(document).ready(function(){
	//$('select[name="visible"]').val();
	$('select[name="sure"]').val(<?=$param['edit_el']['sure'];?>);
	});
</script>
<div class="page-header" >
	<h3>Редактирование адреса перенаправления</h3>
</div>

<div class="row" >
	
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
		
		<?
		$this->FE->Viewer->form('admin/is_backup_check_html',$param);
		?>
		
		<form action="/admin/update/alias/<?=$param['edit_el']['id'];?>" method="POST" >
			
			<div class="form-group">
				<label for="type" >Тип контента</label>
				<input class="form-control" type="text" name="type" value="<?=$param['edit_el']['type'];?>" />
			</div>
			
			<div class="form-group">
				<label for="req" >Перенаправлять с адреса</label>
				<input class="form-control" type="text" name="req" value="<?=$param['edit_el']['req'];?>" />
			</div>
			
			<div class="form-group">
				<label for="to" >Перенаправлять на адрес</label>
				<input class="form-control" type="text" name="to" value="<?=$param['edit_el']['to'];?>" />
			</div>
			
			<div class="form-group">
				<label for="sure" >Характер перенаправления</label>
				<select class="form-control" name="sure" >
					<option value="1" >точное совпадение</option>
					<option value="0" >замена части строки запроса</option>
				</select>
			</div>
			
			<?
			$this->FE->PluginMng->event('admin:viewer:before_update_btn', $param);
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