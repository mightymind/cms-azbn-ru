<?
// ГдеДостать
if($_SESSION['user']['right']['change_seo']) {
//
?>
<script>
$(document).ready(function(){
	//$('select[name="visible"]').val();
	//$('select[name="parent"]').val(<?=$this->FE->as_int($_GET['cat']);?>);
	});
</script>
<div class="page-header" >
	<h3>Редактирование SEO-преднастройки</h3>
</div>

<div class="row" >
	
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
		
		<?
		$this->FE->Viewer->form('admin/is_backup_check_html',$param);
		?>
		
		<form action="/admin/update/seo/<?=$param['edit_el']['id'];?>" method="POST" >
			
			<div class="form-group">
				<label for="title" >Title</label>
				<input class="form-control" type="text" name="title" value="<?=$param['edit_el']['title'];?>" />
			</div>
			
			<div class="form-group">
				<label for="desc" >Description</label>
				<input class="form-control" type="text" name="desc" value="<?=$param['edit_el']['desc'];?>" />
			</div>
			
			<div class="form-group">
				<label for="kw" >Keywords</label>
				<input class="form-control" type="text" name="kw" value="<?=$param['edit_el']['kw'];?>" />
			</div>
			
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