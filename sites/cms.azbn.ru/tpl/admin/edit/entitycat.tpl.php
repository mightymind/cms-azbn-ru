<?
if($_SESSION['user']['right']['change_entitycat_edit']) {
?>
<script>
$(document).ready(function(){
	$('select[name="visible"]').val(<?=$param['edit_el']['visible'];?>);
	$('select[name="parent"]').val(<?=$param['edit_el']['parent'];?>);
	$('select[name="seo"]').val(<?=$param['edit_el']['seo'];?>);
	});
</script>
<div class="page-header" >
	<h3><?=$param['entity']['title'];?>. Обновление категории</h3>
</div>

<div class="row" >
	
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
		
		<?
		$this->FE->Viewer->form('admin/is_backup_check_html',$param);
		?>
		
		<form action="/admin/update/entitycat/<?=$param['entity']['id'];?>/<?=$param['edit_el']['id'];?>/" method="POST" >
			
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
			$this->FE->Viewer->form('admin/entitycat_select_html',$param);
			?>
			
			<?
			$this->FE->Viewer->form('admin/seo_select_html',$param);
			?>
			
			<?
			if($param['entity']['param']['field']['cat']['img']) {
			?>
			
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
					'path'=>'entitycat/img',
					);
				$this->FE->Viewer->form('admin/avatar_upload_html',$param);
				?>
			</div>
			
			<?
			}
			?>
			
			<?
			if($param['entity']['param']['field']['cat']['preview']) {
			?>
			<div class="form-group">
				<label for="preview" >Пояснение</label>
				<textarea class="form-control" name="preview" ><?=$param['edit_el']['preview'];?></textarea>
			</div>
			<?
			}
			?>
			
			
			<?
			if($param['entity']['param']['field']['cat']['main_info']) {
			$param['run_editor']=array(
				'element'=>array(
					'name'=>'main_info',
					'value'=>$param['edit_el']['main_info'],
					'upload_path'=>'entitycat/main_info',
					),
				);
			$this->FE->Viewer->form('admin/form_editor_html',$param);
			}
			?>
			
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