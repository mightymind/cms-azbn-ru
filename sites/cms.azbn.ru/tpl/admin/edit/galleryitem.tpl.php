<?
if($_SESSION['user']['right']['change_galleryitem_edit']) {
?>
<script>
$(document).ready(function(){
	$('select[name="visible"]').val(<?=$param['edit_el']['visible'];?>);
	$('select[name="parent"]').val(<?=$param['edit_el']['gal'];?>);
	$('select[name="user"]').val(<?=$param['edit_el']['user'];?>);
	$('select[name="seo"]').val(<?=$param['edit_el']['seo'];?>);
	});
</script>
<div class="page-header" >
	<h3>Обновление изображения</h3>
</div>

<div class="row" >
	
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
		
		<?
		$this->FE->Viewer->form('admin/is_backup_check_html',$param);
		?>
		
		<form action="/admin/update/galleryitem/<?=$param['edit_el']['id'];?>/" method="POST" >
			
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
			if($_SESSION['user']['right']['change_galleryitem_superuser']) {
				$this->FE->Viewer->form('admin/user_select_html',$param);
				}
			?>
			
			<?
			$this->FE->Viewer->form('admin/gallery_select_html',$param);
			?>
			
			<?
			$this->FE->Viewer->form('admin/seo_select_html',$param);
			?>
			
			<div class="form-group">
				<label for="rating" >Рейтинг</label>
				<input type="number" class="form-control" name="rating" max="999999999" min="1" value="<?=$param['edit_el']['rating'];?>" />
			</div>
			
			<div class="form-group">
				<label for="img" >Изображение</label>
				<?
				$gal=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_gallery']."` WHERE id='{$param['edit_el']['gal']}'");
				if($gal['id']) {
					
				} else {
					$gal=array(
						'w'=>200,
						'h'=>200,
						'crop'=>1,
						);
				}
				$param['img_form']=array(
					'name'=>'img',
					'src'=>$param['edit_el']['img'],
					'w'=>$gal['w'],
					'h'=>$gal['h'],
					'crop'=>$gal['crop'],
					'gray'=>0,
					'path'=>'galleryitem/img',
					);
				$this->FE->Viewer->form('admin/avatar_upload_html',$param);
				?>
			</div>
			
			<div class="form-group">
				<label for="tag" >Теги (через точку с запятой!)</label>
				<input class="form-control" type="text" name="tag" value="<?=$param['edit_el']['tag'];?>" />
			</div>
			
			<div class="form-group">
				<button type="submit" class="btn btn-success" >Обновить изображение</button>
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