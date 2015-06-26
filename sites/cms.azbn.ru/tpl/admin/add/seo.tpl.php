<?
if($_SESSION['user']['right']['change_seo']) {
?>
<script>
$(document).ready(function(){
	//$('select[name="visible"]').val();
	//$('select[name="parent"]').val(<?=$this->FE->as_int($_GET['cat']);?>);
	});
</script>
<div class="page-header" >
	<h3>Добавление SEO-преднастройки</h3>
</div>

<div class="row" >
	
	<div class="col-sm-12 col-lg-12" >
		
		<form action="/admin/create/seo/" method="POST" >
			
			<div class="form-group">
				<label for="title" >Title</label>
				<input class="form-control" type="text" name="title" value="Title, заголовок" />
			</div>
			
			<div class="form-group">
				<label for="desc" >Description</label>
				<input class="form-control" type="text" name="desc" value="Description, описание страницы" />
			</div>
			
			<div class="form-group">
				<label for="kw" >Keywords</label>
				<input class="form-control" type="text" name="kw" value="keywords, of, page, ключевые, слова" />
			</div>
			
			<?
			$this->FE->PluginMng->event('admin:viewer:before_create_btn', $param);
			?>
			
			<div class="form-group">
				<button type="submit" class="btn btn-success" >Добавить</button>
			</div>
		
		</form>
	
		<div class="clear">&nbsp;</div>
	</div>
		
	<div class="clear">&nbsp;</div>
</div>
<?
	}
?>