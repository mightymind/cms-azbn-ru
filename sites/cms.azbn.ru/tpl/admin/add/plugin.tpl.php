<?
if($_SESSION['user']['right']['access_plugin']) {
?>
<script>
$(document).ready(function(){
	//$('select[name="visible"]').val();
	//$('select[name="parent"]').val(<?=$this->FE->as_int($_GET['cat']);?>);
	});
</script>
<div class="page-header" >
	<h3>Установка плагина</h3>
</div>

<div class="row" >
	
	<div class="col-sm-12 col-lg-12" >
		
		<form action="/admin/create/plugin/" method="POST" enctype="multipart/form-data" >
			
			<div class="form-group">
				<label for="url" >URL конфигурационный файл</label>
				<input class="form-control" type="text" name="url" value="http://azbn.ru/cmspluginstore/item/1/" placeholder="Например, http://azbn.ru/cmspluginstore/item/1/" />
			</div>
			
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