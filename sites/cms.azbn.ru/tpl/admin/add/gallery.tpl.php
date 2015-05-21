<?
if($_SESSION['user']['right']['change_gallery_edit']) {
?>
<script>
$(document).ready(function(){
	$('select[name="parent"]').val(<?=$this->FE->as_int($_GET['parent']);?>);
	});
</script>
<div class="page-header" >
	<h3>Создание галереи</h3>
</div>

<div class="row" >
	
	<div class="col-sm-12 col-lg-12" >
		
		<form action="/admin/create/gallery/" method="POST" >
			
			<?
			$this->FE->Viewer->form('admin/title_input_html',$param);
			?>
			
			<div class="form-group">
				<label for="url" >URL</label>
				<input class="form-control" type="text" name="url" />
			</div>
			
			<?
			$this->FE->Viewer->form('admin/visible_select_html',$param);
			?>
			
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
					'src'=>'/img/cms.azbn.ru/default.png',
					'w'=>170,
					'h'=>170,
					'crop'=>1,
					'gray'=>0,
					'path'=>'gallery/img',
					);
				$this->FE->Viewer->form('admin/avatar_upload_html',$param);
				?>
			</div>
			
			<div class="form-group">
				<label for="preview" >Пояснение</label>
				<textarea class="form-control" name="preview" ></textarea>
			</div>
			
			<div class="row">
				
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" >
					
					<div class="form-group">
						<label for="w" >Максимальная ширина изображений, px</label>
						<input type="number" class="form-control" name="w" min="1" max="1000" value="200" />
					</div>
					
				</div>
				
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" >
					
					
					<div class="form-group">
						<label for="h" >Максимальная высота изображений, px</label>
						<input type="number" class="form-control" name="h" min="1" max="1000" value="200" />
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
				<button type="submit" class="btn btn-success" >Создать галерею</button>
			</div>
		
		</form>
	
		<div class="clear">&nbsp;</div>
	</div>
		
	<div class="clear">&nbsp;</div>
</div>
<?
	}
?>