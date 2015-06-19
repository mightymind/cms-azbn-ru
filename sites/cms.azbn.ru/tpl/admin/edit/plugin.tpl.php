<?
if($_SESSION['user']['right']['access_plugin']) {
?>
<script>
$(document).ready(function(){
	$('select[name="status"]').val(<?=$param['edit_el']['status'];?>);
	});
</script>
<div class="page-header" >
	<h3>Изменение настроек плагина <i><?=$param['edit_el']['title'];?></i></h3>
</div>

<div class="row" >
	
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
		
		<form action="/admin/update/plugin/<?=$param['edit_el']['id'];?>/" method="POST" >
			
			<div class="form-group">
				<label for="status" >Статус</label>
				<select class="form-control" name="status" >
					<option value="1" >плагин включен</option>
					<option value="0" >плагин заблокирован</option>
				</select>
			</div>
			
			<?
			$this->FE->Viewer->form('admin/rating_input_html',$param);
			?>
			
			<?
			if(count($param['edit_el']['param'])) {
				foreach($param['edit_el']['param'] as $name=>$value) {
			?>
			
			<div class="form-group">
				<label for="param[<?=$name;?>]" ><?=$name;?></label>
				<input class="form-control" type="text" name="param[<?=$name;?>]" value="<?=$value;?>" />
			</div>
			
			<?
				}
			
			?>
			
			<?
			
			} else {
			?>
			
			<p>Плагин не имеет настроек</p>
			
			<?
			}
			?>
			
			<div class="form-group">
				<button type="submit" class="btn btn-success" >Обновить запись</button>
			</div>
		
		</form>
	
		<div class="clear">&nbsp;</div>
	</div>
		
	<div class="clear">&nbsp;</div>
</div>
<?
	}
?>