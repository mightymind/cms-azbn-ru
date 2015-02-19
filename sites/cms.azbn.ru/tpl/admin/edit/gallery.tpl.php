<?
if($_SESSION['user']['right']['change_gallery_edit']) {
?>
<script>
$(document).ready(function(){
	$('select[name="visible"]').val(<?=$param['edit_el']['visible'];?>);
	$('select[name="parent"]').val(<?=$param['edit_el']['parent'];?>);
	$('select[name="seo"]').val(<?=$param['edit_el']['seo'];?>);
	$('select[name="crop"]').val(<?=$param['edit_el']['crop'];?>);
	});
</script>
<div class="page-header" >
	<h3>Обновление галереи</h3>
</div>

<div class="row" >
	
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
		
		<?
		$this->FE->Viewer->form('admin/is_backup_check_html',$param);
		?>
		
		<form action="/admin/update/gallery/<?=$param['edit_el']['id'];?>/" method="POST" >
			
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
			$this->FE->Viewer->form('admin/gallery_select_html',$param);
			?>
			
			<?
			$this->FE->Viewer->form('admin/seo_select_html',$param);
			?>
			
			<div class="form-group">
				<label for="img" >Изображение</label>
			<?
				$param['img_form']=array(
					'name'=>'img',
					'src'=>$param['edit_el']['img'],
					'w'=>$param['edit_el']['w'],
					'h'=>$param['edit_el']['h'],
					'crop'=>$param['edit_el']['crop'],
					'gray'=>0,
					'path'=>'gallery/img',
					);
				$this->FE->Viewer->form('admin/avatar_upload_html',$param);
				?>
			</div>
			
			<div class="form-group">
				<label for="preview" >Пояснение</label>
				<textarea class="form-control" name="preview" ><?=$param['edit_el']['preview'];?></textarea>
			</div>
			
			<div class="row">
				
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" >
					
					<div class="form-group">
						<label for="w" >Максимальная ширина изображений, px</label>
						<input type="number" class="form-control" name="w" min="1" max="1000" value="<?=$param['edit_el']['w'];?>" />
					</div>
					
				</div>
				
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" >
					
					
					<div class="form-group">
						<label for="h" >Максимальная высота изображений, px</label>
						<input type="number" class="form-control" name="h" min="1" max="1000" value="<?=$param['edit_el']['h'];?>" />
					</div>
					
				</div>
				
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
					
					<div class="form-group">
						<div class="form-group">
							<label for="crop" >Всегда обрезать и масштабировать до указанных размеров</label>
							<select class="form-control" name="crop" >
								<option value="1" >обрезать, независимо от размеров</option>
								<option value="0" >не обрезать, подгонять только максимальную сторону под размер</option>
							</select>
						</div>
					</div>
					
				</div>
				
			</div>
			
			<?
			$this->FE->Viewer->form('admin/filter_checkbox_list_html',$param);
			?>
			
			<div class="form-group">
				<button type="submit" class="btn btn-success" >Обновить галерею</button>
			</div>
		
		</form>
		
		<?
		$this->FE->Viewer->form('admin/backup_list_html',$param);
		?>
	
		<div class="clear">&nbsp;</div>
	</div>
		
	<div class="clear">&nbsp;</div>
</div>




<div class="clear20">&nbsp;</div>
<div class="clear30">&nbsp;</div>

<div class="row" >
	
	<div class="col-sm-12 col-lg-12" >
	
	<h3>
		Изображения галереи
		<a href="/admin/add/galleryitem/?gal=<?=$param['edit_el']['id'];?>" title="Добавить изображение" ><img class="icon" src="/img/cms.azbn.ru/add.png" /></a>
	<?
	$param['img_param']=array(
		'w'=>$param['edit_el']['w'],
		'h'=>$param['edit_el']['h'],
		'gal'=>$param['edit_el']['id'],
		'seo'=>$param['edit_el']['seo'],
		//'crop'=>$param['edit_el']['crop'],
		//'gray'=>0,
		'path'=>'galleryitem/img',
		);
	$this->FE->Viewer->form('admin/galleryitem_massupload',$param);
	?>
	</h3>
	
	<hr />
<?

$galleryitem_list=$this->FE->DB->dbSelect("SELECT * FROM `".$this->FE->DB->dbtables['t_galleryitem']."` WHERE gal='{$param['edit_el']['id']}' ORDER BY id DESC");
if(mysql_num_rows($galleryitem_list)) {
?>

	<table class="table table-striped table-bordered table-hover table-condensed" >
		<tbody>
			<tr class="info" id="table-of-galleryitem-header" >
				<td width="20%">Изображение</td>
				<td width="60%">Заголовок</td>
				<td width="20%">Функции</td>
			</tr>
	<?
	while($row=mysql_fetch_array($galleryitem_list)) {
		?>
			<tr class="visible<?=$row['visible'];?>" >
				<td>
					<a href="<?=$row['img'];?>" target="_blank" ><img src="<?=$row['img'];?>" /></a>
				</td>
				<td>
					<p><?=$row['title'];?></p>
				</td>
				<td>
					<?
					if($_SESSION['user']['right']['change_galleryitem_edit']) {
					?>
					<a href="/admin/edit/galleryitem/<?=$row['id'];?>/" ><img class="icon" src="/img/cms.azbn.ru/edit.png" /></a>
					<?
						}
					?>
					<?
					if($_SESSION['user']['right']['change_galleryitem_delete']) {
					?>
					<a class="confirm-delete" href="/admin/delete/galleryitem/<?=$row['id'];?>/" ><img class="icon" src="/img/cms.azbn.ru/delete.png" /></a>
					<?
						}
					?>
				</td>
			</tr>
		<?
		}
	?>
		</tbody>
	</table>
	
		<div class="clear">&nbsp;</div>
	</div>
		
	<div class="clear">&nbsp;</div>
</div>
	<?
	}
	}

?>