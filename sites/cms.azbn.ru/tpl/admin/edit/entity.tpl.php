<?
if($_SESSION['user']['right']['change_entity_edit']) {
?>
<script>
$(document).ready(function(){
	$('select[name="ftsearch"]').val(<?=$param['edit_el']['ftsearch'];?>);
	});
</script>
<div class="page-header" >
	<h3>Обновление сущности</h3>
</div>

<div class="row" >
	
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
		
		<?
		$this->FE->Viewer->form('admin/is_backup_check_html',$param);
		?>
		
		<form action="/admin/update/entity/<?=$param['edit_el']['id'];?>/" method="POST" >
			
			<?
			$this->FE->Viewer->form('admin/title_input_html',$param);
			?>
			
			<div class="form-group">
				<label for="url" >URL</label>
				<input class="form-control" type="text" name="url" value="<?=$param['edit_el']['url'];?>" readonly="readonly" />
			</div>
			
			<div class="form-group">
				<label for="ftsearch" >Поисковая индексация</label>
				<select class="form-control" name="ftsearch" >
					<option value="1" >производится</option>
					<option value="0" >не производится</option>
				</select>
			</div>
			
			<div class="form-group">
				<button type="submit" class="btn btn-success" >Обновить запись</button>
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